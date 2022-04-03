<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
{
    //
    use HasApiTokens;

    /**
     * to register user
     *
     * @param Request $request
     * @return Response either fail or success
     */
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|git:users',
            'password' => 'required',
        ]);

        $otp = rand(100000, 999999);

        // try {

        $user_phone_number = $request->phone_number;
        $demo = Nexmo::message()->send([
            'to' =>  '91' . $user_phone_number,
            'from' => '919638824606',
            'text' => $otp,
        ]);

        if ($demo) {
            Otp::create([
                'phone_number' => $request->phone_number,
                'otp_number' => $otp,
            ]);
        }
        return response()->json('OTP sent successfully!', 200);
    }

    /**
     * to login user
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('phone_number', $request->phone_number)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;
        return response()->json([
            //'user'=>$user,
            'token' => $token,
        ], 200);

    }

    /**
     * to logout user
     *
     * @return void
     */
    public function logout()
    {

        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => "success",
            'message' => 'successfully logged out!',

        ],200);

    }






}
