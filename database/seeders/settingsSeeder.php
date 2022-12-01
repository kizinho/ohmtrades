<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Setting;

class settingsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $settings = new Setting();
        $settings->site_email = 'info@cobitfx.com';
        $settings->site_phone = '+19175146371';
        $settings->send_notify_email = 'info@cobitfx.com';
        $settings->site_name = 'OHMTrade';
        $settings->address = '1270 Sixth Avenue, New York, USA.';
        $settings->site_url = 'https://cobitfx.com';
        $settings->site_code = 'DM';
        $settings->logo = 'images/logo/logo.png';
        $settings->withdraw_charge = '0';
        $settings->favicon = 'images/favicon/favicon.png';
        $settings->location_map = 'OHMTrade';
        $settings->location = 'OHMTrade';
        $settings->copy_right = '© 2022 all rights reserved';
        $settings->block_io_pin = '123456';
        $settings->min_withdraw = '0';
        $settings->level_1 = 4.9;
        $settings->level_eduction_license_1 = 23.00;
        $settings->level_eduction_license_2_7 = 8;
        $settings->level_2 = 3;
        $settings->level_3 = 2;
        $settings->investment_payment_mode = '0';
        $settings->auto_withdraw = true;
        $settings->email_body = '<p> </p>
<div class="wrapper" style="background-color: #39662e;">
<table style="border-collapse: collapse; table-layout: fixed; color: #b8b8b8; font-family: Ubuntu,sans-serif;" align="center">
<tbody>
<tr>
<td class="preheader__snippet" style="padding: 10px 0 5px 0; vertical-align: top; width: 280px;"> </td>
<td class="preheader__webversion" style="text-align: right; padding: 10px 0 5px 0; vertical-align: top; width: 280px;"> </td>
</tr>
</tbody>
</table>
<table id="emb-email-header-container" class="header" style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto;" align="center">
<tbody>
<tr>
<td style="padding: 0; width: 600px;">
<div class="header__logo emb-logo-margin-box" style="font-size: 26px; line-height: 32px; color: #fff; font-family: Roboto,Tahoma,sans-serif; margin: 6px 20px 20px 20px;">
<div id="emb-email-header" class="logo-left" style="font-size: 0px !important; line-height: 0 !important;" align="left"><img style="height: auto; width: 100%; border: 0; max-width: 312px;" src="https://metafxgroup.com/images/logo/logo.jpg" alt="" width="300" height="44"></div>
</div>
</td>
</tr>
</tbody>
</table>
<table class="layout layout--no-gutter" style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;" align="center">
<tbody>
<tr>
<td class="column" style="padding: 0px; text-align: left; vertical-align: top; color: rgb(96, 102, 109); line-height: 21px; font-family: sans-serif; width: 600px;">
<div style="font-size: 14px; margin-left: 20px; margin-right: 20px; margin-top: 24px;">
<div style="line-height: 10px; font-size: 1px;"> </div>
</div>
<div style="font-size: 14px; margin-left: 20px; margin-right: 20px;">
<h2>Dear {{name}},</h2>
<p><strong>{{message}}</strong></p>
</div>
<div style="font-size: 14px; margin-left: 20px; margin-right: 20px;"><br></div>
<div style="margin-left: 20px; margin-right: 20px; margin-bottom: 24px;">
<p class="size-14" style="margin-top: 0px; margin-bottom: 0px; line-height: 21px;"><font size="3">Thanks,</font><br> <strong style="font-size: 14px;">OHMTrade</strong></p>
</div>
</td>
</tr>
</tbody>
</table><br>
</div>

<br>
<br>';
        $settings->save();
    }

}
