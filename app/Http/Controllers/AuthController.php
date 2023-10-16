<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     * 
     */
    public function login(AuthRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = $request->user();

            if ($user->email_verified_at === null) {
                return response()->json([
                    'code' => 401,

                    'error' => 'Account not validate in email',
                    'message' => 'Account is not validate, verify your email',
                ], 401);
            } else {

                $token = $user->createToken('API TOKEN');

                return response()->json([
                    'code' => 200,
                    'data' => [
                        'token' => [
                            'type' => 'Bearer',
                            'expires_at' =>  Carbon::parse($token->accessToken->expires_at),
                            'access_token' => $token->plainTextToken
                        ],
                        'user' => [

                            'phone' => $user->phone,
                            'email' => $user->email,
                            'avatar' => $user->avatar,
                            'login' => $user->login,
                        ]
                    ]
                ]);
            }
        }

        return response()->json([
            'code' => 401,
            'error' => 'invalid_client',
            'message' => 'Client authenfication failed',
        ], 401);
    }


    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->stateless()->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'login' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'email_verified_at' => Carbon::now(),
                    'derniereConnexion' => Carbon::now(),
                    'password' => encrypt('my-google')

                ]);

                Auth::login($newUser);
            }

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'access_token' => $user->token
                    ],
                    'user' => [
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'login' => $user->name,
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'login' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'email_verified_at' => Carbon::now(),
                    'derniereConnexion' => Carbon::now(),
                    'password' => encrypt('my-google')

                ]);

                Auth::login($newUser);
            }

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'access_token' => $user->token
                    ],
                    'user' => [

                        'phone' => $user->phone,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'login' => $user->name,
                    ]
                ]
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function twitterRedirect(){
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterCallback(){
        try {

            $user = Socialite::driver('twitter')->stateless()->user();

            $finduser = User::where('twitter_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'login' => $user->name,
                    'email' => $user->email,
                    'twitter_id' => $user->id,
                    'email_verified_at' => Carbon::now(),
                    'derniereConnexion' => Carbon::now(),
                    'password' => encrypt('password')

                ]);

                Auth::login($newUser);
            }

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'access_token' => $user->token
                    ],
                    'user' => [

                        'phone' => $user->phone,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'login' => $user->name,
                    ]
                ]
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout(Request $request, User $user)
    {

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            Auth::guard('web')->logout();

            $user->tokens()->delete();

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'code' => 200,
                'data' => $user,
                'message' => 'vous êtes bien déconnecté'
            ]);
        }
    }
}
