<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => ['web']], function () {

    // Route::get('facebook/callback', [AuthController::class, 'LoginWithFacebook']);

    Route::get('auth', [AuthController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [AuthController::class, 'callbackFromFacebook'])->name('callback');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('callback/google', [AuthController::class, 'handleCallback']);
});

Route::apiResource("users", UserController::class);

Route::post('login', [AuthController::class, 'login'])->name('login');


Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('send-email', [UserController::class, 'sendEmail'])->name('sendEmail');

Route::get('update-verification-email/{user}', [UserController::class, 'verification'])->name('verification');

Route::post('users/avatar', [UserController::class, 'uploadAvatar'])->name('users.avatar');

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('updatePassword');
