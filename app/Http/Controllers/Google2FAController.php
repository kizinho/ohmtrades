<?php

namespace App\Http\Controllers;

use Crypt;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \ParagonIE\ConstantTime\Base32;
use App\Models\Admin\Setting;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use \App\Http\Controllers\Traits\HasError;
use Illuminate\Support\Facades\Redirect;

class Google2FAController extends Controller {

    use HasError;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('web');
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function enableTwoFactor(Request $request) {
//        $google2fa = new Google2FA();
//
//
//        //get user
//        $user = $request->user();
//
//        if (empty($user->google2fa_secret)) {
//            //generate new secret
//            $secret = $this->generateSecret();
//            //encrypt and then save secret
//            $user->google2fa_secret = Crypt::encrypt($secret);
//            $user->google2fa_secret_status = true;
//            $user->save();
//            //generate image for QR barcode
//            $g2faUrl = $google2fa->getQRCodeUrl(
//                    $request->getHttpHost(), $user->email, $secret, 200
//            );
//            $settings = Setting::whereId(1)->first();
//            $qrCode = new QrCode($g2faUrl);
//            $qrCode->setSize(300);
//            $qrCode->setWriterByName('png');
//            $qrCode->setEncoding('UTF-8');
//            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
//            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
//            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
//            $qrCode->setLogoPath(public_path() . '/' . $settings['logo']);
//            $qrCode->setLogoSize(32, 32);
//            $qrCode->setValidateResult(false);
//            $qrcode_image = $qrCode->writeDataUri();
//            return [
//                'image' => $qrcode_image,
//                'secret' => $secret,
//                'status' => 'success',
//                'message' => '2fa successfully ensabled',
//                'check_status' => '1'
//            ];
//        } else {
//            $user->google2fa_secret_status = true;
//            $user->save();
//        }
//
//        return [
//            'status' => 'success',
//            'message' => '2fa successfully ensabled',
//            'check_status' => '0'
//        ];
//    }
    public function enableTwoFactor(Request $request) {
        $google2fa = new Google2FA();


        //get user
        $user = $request->user();

        //generate new secret
        $secret = $this->generateSecret();
        //encrypt and then save secret
        $user->google2fa_secret = Crypt::encrypt($secret);
        //$user->google2fa_secret_status = true;
        $user->save();
        //generate image for QR barcode
        $g2faUrl = $google2fa->getQRCodeUrl(
                $request->getHttpHost(), $user->email, $secret, 200
        );
        $settings = Setting::whereId(1)->first();
        $qrCode = new QrCode($g2faUrl);
        $qrCode->setSize(180);
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(public_path() . '/' . $settings['logo']);
        $qrCode->setLogoSize(32, 32);
        $qrCode->setValidateResult(false);
        $qrcode_image = $qrCode->writeDataUri();
        // $user->google2fa_secret_status = true;
        $user->save();
        $data['image'] = $qrcode_image;
        $data['secret'] = $secret;
        return view('user.2fa', $data);
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pin(Request $request) {
        $user = $request->user();
        $input = $request->all();
        $rules = [
            'pin' => 'required|numeric'
        ];
        $error = static::getErrorMessageSweet($input, $rules);
        if ($error) {
            return $error;
        }

        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $request->pin;
        $user_secret = Crypt::decrypt($user->google2fa_secret);

        $timestamp = $google2fa->verifyKeyNewer($user_secret, $secret, $user->google2fa_ts);

        if ($timestamp !== false) {
            $user->update(['google2fa_ts' => $timestamp]);
            //make secret column blank
            $user->google2fa_secret_status = true;
            $user->save();

            session()->flash('message.level', 'success');
            session()->flash('message.color', 'green');
            session()->flash('message.content', '2fa enabled');
            return redirect('profile/personal');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid 2fa code was entered');
            return Redirect::back();
        }
    }

    public function disableTwoFactor(Request $request) {
        $user = $request->user();

        //make secret column blank
        $user->google2fa_secret_status = false;
        $user->save();

        session()->flash('message.level', 'success');
        session()->flash('message.color', 'green');
        session()->flash('message.content', '2fa disabled');
        return redirect()->back();
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret() {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }

}
