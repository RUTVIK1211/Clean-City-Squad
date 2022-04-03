<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ForgotPasswordController extends Controller
{
    /**
     * Forgot password function
     *
     * @return void
     */
    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string',
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }










    }










    // public function forgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     if ($status == Password::RESET_LINK_SENT) {
    //         return [
    //             'status' => __($status)
    //         ];
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => [trans($status)],
    //     ]);
    // }

//     public function resetPassword (Request $request)
//     {

//         $user = User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);
//         if($user){

//                 return response()->json([

//                 'status' => "success",

//                 'message' => 'successfully updated password!',

//         ]);

//         }else{

//             return response()->json([

//             'status' => "error",

//             'message' => 'can not updated password!',

//             ]);

//         }
// }
