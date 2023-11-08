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
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="login",
     *      description="login",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="email", type="string", format="email", example="exmple@exemple.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="jdjfk3237&$#", description ="votre motde passe"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
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

 /**
     * @OA\Post(
     *      path="/api/facebook/auth",
     *      operationId="loginUsingFacebook",
     *      tags={"Auth"},
     *      summary="login with facebook",
     *      description="login with facebook",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur avec facebook",
     *
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
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

 /**
     * @OA\Post(
     *      path="/api/auth/google",
     *      operationId="redirectToGoogle",
     *      tags={"Auth"},
     *      summary="login with google",
     *      description="login with google",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur avec google",
     *
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
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

 /**
     * @OA\Post(
     *      path="/api/auth/twitter",
     *      operationId="twitterRedirect",
     *      tags={"Auth"},
     *      summary="login with twitter",
     *      description="login with twitter",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur avec twitter",
     *
    
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function twitterRedirect(){
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterCallback(){
        try {

            $user = Socialite::driver('twitter')->user();

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


     /**
     * @OA\Post(
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="logout of user",
     *      description="logout",
     *      @OA\RequestBody(
     *      required=true,
     *      description="déconnexion d'un utilisateur",
     *
     * 
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="deconnexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
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
