<?php

namespace App\Http\Controllers;

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
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        
        $otp = rand(100000,999999);

        try {
            Nexmo::message()->send([
                'to' => '919638824606',
                'from' => '919638824606',
                'text' => $otp,
            ]);

            return response('OTP sent successfully!',200);

        
        } catch (\Throwable $th) {
            return response('There was an error in sending the OTP.', 500);
        }


        // $user = User::create([
        //     'name' => $request->name,
        //     'phone_number' => $request->phone_number,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        // $token = $user->createToken('myToken')->plainTextToken;
        // return response([
        //     'user' => $user,
        //     'token' => $token,
        // ], 201);
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
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;
        return response([
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
        return response([
            'message' => 'successfully logged out!',
        ]);

    }

}
