<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Forgot password function
     *
     * @return void
     */
    public function forgot()
    {
        // $credentials = request()->validate(['email' => 'required|email']);
        // $users = User::where('email', '=', $request->input('email'))->first();

        // if ($users === null) {
        //     // User does not exist
        //     return response()->json(["message" => "Email ID does not exist."], 400);
        // } else {
        //     // User exits
        // }
        
        // if () {
        //     Password::sendResetLink($credentials);

        // return response()->json(["message" => 'Reset password link sent on your email id.']);
           
        // }

        
    }

    /**
     * Reset password
     *
     * @return void
     */
    public function reset()
    {
        $credentials = request()->validate([
            'token' => 'required|string',
            'password' => 'required|string',
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["message" => "Invalid token provided"], 400);
        }

        return response()->json(["message" => "Password has been successfully changed"]);
    }
}