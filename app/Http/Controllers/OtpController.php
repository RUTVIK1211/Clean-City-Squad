<?php

namespace App\Http\Controllers;

use Laravel\Sanctum\HasApiTokens;
use Nexmo\Laravel\Facade\Nexmo;

class OtpController extends Controller
{
    //
    use HasApiTokens;
    /**
     * Otp generation function
     *
     * @return void
     */
    public function otpGeneration()
    {

        try {
            Nexmo::message()->send([
                'to' => '9191066h64085',
                'from' => '919638824606',
                'text' => '',
            ]);

            dd('SMS Sent Successfully.');

        } catch (\Throwable $th) {
            return response('There was an error in sending the OTP.', 500);
        }
    }
}
