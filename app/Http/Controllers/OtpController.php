<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class OtpController extends Controller
{
    //
    use HasApiTokens;

    /**

     * Verify OTP

     */

    public function otpVerification(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'otp_number' => 'required',

        ]);

        //check in user table where number and in otp table if otp matches

        //if not matching return error

        //else reset

        $otp = Otp::where(['phone_number' => $request->phone_number, 'otp_number' => $request->otp_number])->first();

        if ($otp) {

            $otp->delete();

            $user = User::create([

                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_otp_verified' => 1,

            ]);

            $token = $user->createToken('myToken')->plainTextToken;

            return response()->json([

                'user' => $user,

                'token' => $token,

            ], 201);

        } else {
            return response()->json(['status' => "Failed", "message" => 'Otp unverified'], 422);
        }

    }
}
