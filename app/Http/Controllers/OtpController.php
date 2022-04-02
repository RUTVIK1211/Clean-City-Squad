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

        $otp = rand(100000,999999);

        try {
            Nexmo::message()->send([
                'to' => '919106664085',
                'from' => '919638824606',
                'text' => $otp,
            ]);

            

        } catch (\Throwable $th) {
            return response('There was an error in sending the OTP.', 500);
        }
    }
}
