<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\VoteController;
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

    Route::get('facebook/auth', [AuthController::class, 'loginUsingFacebook'])->name('login');
    Route::get('facebook/callback', [AuthController::class, 'callbackFromFacebook'])->name('callback');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('callback/google', [AuthController::class, 'handleCallback']);

    Route::get('auth/twitter', [AuthController::class, 'twitterRedirect'])->name('login.twitter');
    Route::get('callback/twitter', [AuthController::class, 'twitterCallback']);
});

Route::apiResource("users", UserController::class)->except('update', 'destroy');
Route::put('users', [UserController::class,'update'])->name('users.update')->middleware('auth:sanctum');
Route::delete('users', [UserController::class,'destroy'])->name('users.destroy')->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login'])->name('login');


Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::post('send-email', [UserController::class, 'sendEmail'])->name('send.email');

Route::get('update-verification-email/{user}', [UserController::class, 'verification'])->name('verification');

Route::post('users/avatar', [UserController::class, 'uploadAvatar'])->name('users.avatar')->middleware('auth:sanctum');

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('updatePassword')->middleware('auth:sanctum');


//

Route::apiResource("categories", CategorieController::class);//->middleware('auth:sanctum');


Route::apiResource("posts", PostController::class)->except('store', 'update', 'destroy');
Route::post('posts', [PostController::class,'store'])->name('posts.store')->middleware('auth:sanctum');
Route::put('posts/{post}', [PostController::class,'update'])->name('posts.update')->middleware('auth:sanctum');
Route::delete('posts/{post}', [PostController::class,'destroy'])->name('posts.destroy')->middleware('auth:sanctum');


Route::apiResource('parametres', ParameterController::class)->middleware('auth:sanctum');


Route::apiResource('participations', ParticipationController::class)->except('store', 'update', 'destroy');
Route::post('participations', [ParticipationController::class,'store'])->name('participations.store')->middleware('auth:sanctum');
Route::put('participations/{post}', [ParticipationController::class,'update'])->name('participations.update')->middleware('auth:sanctum');
Route::delete('participations/{post}', [ParticipationController::class,'destroy'])->name('participations.destroy')->middleware('auth:sanctum');


Route::apiResource('votes', VoteController::class)->except('store', 'update');
Route::post('votes', [VoteController::class,'store'])->name('votes.store')->middleware('auth:sanctum');
Route::put('votes/{post}', [VoteController::class,'update'])->name('votes.update')->middleware('auth:sanctum');


Route::apiResource('actions', ActionController::class)->middleware('auth:sanctum');


Route::apiResource('upload', MediaController::class)->middleware('auth:sanctum');