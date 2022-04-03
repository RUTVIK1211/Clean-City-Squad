<?php

use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\Fetchdata;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

//protected routes
Route::post('/otp/verify', [OtpController::class, 'otpVerification']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/postComplaint', [ComplaintsController::class, 'postComplaint']);
    Route::get('/getallComplaints', [ComplaintsController::class, 'getallComplaints']);
    Route::get('/getComplaint/{id}', [ComplaintsController::class, 'getComplaintById']);
    Route::POST('/updateComplaint/{id}', [ComplaintsController::class, 'updateComplaint']);
    Route::delete('/deleteComplaint/{id}', [ComplaintsController::class, 'deleteComplaint']);
});
Route::get('get-area', [Fetchdata::class, 'getArea']);
Route::get('get-complain-type', [Fetchdata::class, 'getComplainType']);
Route::post('/password/reset', [ForgotPasswordController::class, 'reset']);
Route::post('/password/forgot', [ForgotPasswordController::class, 'forgot']);
Route::post('/reset-password',[UserController::class,'resetPassword']);
