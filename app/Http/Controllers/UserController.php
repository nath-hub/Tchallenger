<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserDelete;
use App\Services\Facades\UserFacade as UserService;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string 
     */
    public function index()
    {
        return User::all();
    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="store",
     *      tags={"User"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="first_name", type="string", format="string", example="laporte", description ="votre nom"),
     *       @OA\Property(property="last_name", type="string", format="string", example="jean", description ="votre prenom"),
     *       @OA\Property(property="country", type="string", format="string", example="france", description ="votre pays"),
     *       @OA\Property(property="town", type="string", format="string", example="paris", description ="votre ville"),
     *       @OA\Property(property="type_account", type="string", format="string", example="INDIVIDUAL", description ="votre type de compte"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *       @OA\Property(property="phone", type="string", format="string", example="123456", description ="votre telephone"),
     *       @OA\Property(property="role", type="string", format="string", example="USER", description ="votre role"),
     *       @OA\Property(property="state", type="string", format="string", example="ACTIF", description ="votre etat"),
     *       @OA\Property(property="birth_date", type="date", format="string", example="2023-09-11", description ="votre date de naissance"),            
     *       @OA\Property(property="name_enterprise", type="string", format="string", example="santa lucia", description ="nom de votreentreprise"), 
     *       @OA\Property(property="siren", type="string", format="string", example="93984rhrfbdfn", description ="votre siren"),
     *       @OA\Property(property="commercial_register", type="string", format="string", example="RNNKNKD323", description ="votre RN"),  
     *       @OA\Property(property="address", type="string", format="string", example="54 rue saint augustin", description ="votre adresse"),
     *       @OA\Property(property="web_site", type="string", format="string", example="exemple.com", description ="votre site web"), 
     *       @OA\Property(property="description", type="string", format="string", example="information sur l'entreprise", description ="votre description"),
     *      
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur bien Creer."),
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
    public function store(StoreUserRequest $request)
    {
        $this->authorize("create", User::class);

        $input = $request->validated();

        $data = UserService::store($input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $data = UserService::view($user);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return string
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //$this->authorize('update', $user);

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            $input = $request->validated();

            $data = UserService::update($user, $input);

            return response()->json([
                'code' => 201,
                'data' => $data
            ]);
        }
    }


    public function sendEmail(UpdateUserRequest $request, User $user)
    {
        //permet de recuperer l'adresse mail de l'utilisateur pour verifier si le compte 
        // l'appartient afin qu'il modifie sont mot de passe ou en cas de mot de passe oublier

        $this->authorize('sendEmail', $user);

        $input = $request->validated();

        $data = UserService::sendEmail($user, $input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    public function verification(User $user)
    {

        //bouton modifier dans le compte de l'utilisateur 

        $this->authorize('sendCode', $user);

        UserService::verification($user);

        return view('welcome');
    }

    public function uploadAvatar(StoreUserRequest $request, User $user)
    {
        $this->authorize('uploadAvatar', $user);

        $data = UserService::uploadAvatar($request->file('avatar'));

        return response()->json($data, 200);
    }


    public function updatePassword(UpdateUserRequest $request, User $user)
    {

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            $input = $request->validated();

            return UserService::updatePassword($input, $user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    public function destroy(User $user)
    {
        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {  
            $user = new UserDelete();
            $user->phone = $user['first_name'];
            $user->email = $user['email'];
            $user->avatar = $user['avatar'];
            $user->login = $user['login'];
            $user->active = $user['active'];
            $user->facebook_id = $user['facebook_id'];
            $user->google_id = $user['google_id'];
            $user->twitter_id = $user['twitter_id'];
            $user->derniereConnexion = $user['derniereConnexion'];
            $user->code = $user['code'];
            $user->email_verified_at = $user['email_verified_at'];
            $user->password = $user['password'];
            $user->date_creation = $user['created_at'];
            $user->derniere_mise_a_jour = $user['updated_at'];
            $user->date_delete = Carbon::now();
    
            $user->save();
    
            $state = $user->delete();



           return response()->json([
                "state" => $state,
                'message' => 'users successfull delete'
            ], 202);
        }
    }
}
