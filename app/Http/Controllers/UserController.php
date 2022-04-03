<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

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

        try {
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('myToken')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (ValidationException $th) {
            return response($th->errors());
        }

    }

    /**
     * to login user
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        try {
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
                'user'=>$user,
                'token' => $token,
            ], 200);
        } catch (ValidationException $th) {
            return response($th->errors());
        }
    }

    /**
     * to logout user
     *
     * @return void
     */
    public function logout()
    {

        try {
            auth()->user()->tokens()->delete();
            return response([
                'message' => 'successfully logged out!',
            ]);
        } catch (\Throwable $th) {
            return response('Logout unsuccessful');
        }

    }

}
