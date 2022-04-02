<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    use HasApiTokens;
    public function register(Request $request)
    {

        
        
        $request->validate([
            
            'name'=>'required',
            
            'phone_number'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token=$user->createToken('myToken')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ],201);
    }
    public function logout(){

        auth()->user()->tokens()->delete();
        return response([
            'message'=>'successfully logged out!'
        ]);

    }
    public function login(Request $request){
        $request->validate([
            'phone_number'=>'required',
            'password'=>'required'
        ]);
        $user=User::where('phone_number',$request->phone_number)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response([
                'message'=>'Invalid credentials'
            ],401);
        }

        $token=$user->createToken('myToken')->plainTextToken;
        return response([
            //'user'=>$user,
            'token'=>$token
        ],200);



    }
    public function index(Request $request)
    {

        return $request->user();

    }
    



}
