<?php

namespace App\Http\Controllers\Api;

use Crypt;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \ParagonIE\ConstantTime\Base32;
use App\Models\Admin\Setting;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;

class Google2FAController extends Controller {

    public function enableTwoFactor(Request $request) {
        $google2fa = new Google2FA();

        //get user
        $user = $request->user();

        //generate new secret
        $secret = $this->generateSecret();
        //encrypt and then save secret
        $user->google2fa_secret = Crypt::encrypt($secret);
        $user->google2fa_secret_status = true;
        $user->save();
        //generate image for QR barcode
        $g2faUrl = $google2fa->getQRCodeUrl(
                $request->getHttpHost(), $user->email, $secret, 200
        );
        $settings = Setting::whereId(1)->first();
        $qrCode = new QrCode($g2faUrl);
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(public_path() . '/' . $settings['logo']);
        $qrCode->setLogoSize(32, 32);
        $qrCode->setValidateResult(false);
        $qrcode_image = $qrCode->writeDataUri();
        $user->google2fa_secret_status = true;
        $user->save();
        $data['image'] = $qrcode_image;
        $data['secret'] = $secret;
        return [
            'status' => 200,
            'twoFactor' => $data
        ];
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request) {
        $user = $request->user();

        //make secret column blank
        $user->google2fa_secret_status = false; 
        $user->save();
        return [
            'status' => 200,
            'message' => '2fa disabled'
        ];
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
