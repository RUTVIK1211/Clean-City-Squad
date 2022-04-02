<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
// Route::get('/unautherize',function(Request $request){
//     return response()->json([
//         'code'=>401,'message'=>'U r not authorized'
//     ]);
// })->name('unautherize');
//protected routes

Route::middleware('auth:sanctum')->group(function(){
    
// Route::get('/otp-generation',UserController::class,'/otp_generation');
Route::post('/logout',[UserController::class,'logout']);
Route::get('/myinfo',[UserController::class,'index']);

});

