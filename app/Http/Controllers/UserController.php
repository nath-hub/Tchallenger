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
     * @OA\Get(
     *     path="/public/api/users",
     *      operationId="index",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function index()
    {
        return User::all();
    }

    /**
     * @OA\Post(
     *      path="/public/api/users",
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
     *       @OA\Property(property="login", type="string", format="string", example="laporte", description ="votre login"),
     *       @OA\Property(property="avatar", type="string", format="string", example="https://kdjfkd.png", description ="votre photo"),
     *       @OA\Property(property="active", type="boolean", format="1", example="1", description ="l'etat de votre compte"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *       @OA\Property(property="phone", type="string", format="string", example="123456", description ="votre telephone"),
         
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
     * @OA\Get(
     *     path="/public/api/users/{id}",
     *      operationId="show",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
     * @OA\Put(
     *     path="/public/api/users/{id}",
     *      operationId="update",
     *      tags={"User"},
     *      summary="Update User",
     *      description="Update User",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="reponse de la modification"),
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

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

 /**
     * @OA\Post(
     *      path="/public/api/send-email",
     *      operationId="sendEmail",
     *      tags={"User"},
     *      summary="verification",
     *      description="send email",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Envoie du mail de verification a un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),  
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="mail bien envoyer."),
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


     /**
     * @OA\Get(
     *     path="/public/api/update-verification-email/{id}",
     *      operationId="verification",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function verification(User $user)
    {

        //bouton modifier dans le compte de l'utilisateur 

        $this->authorize('sendCode', $user);

        UserService::verification($user);

        return view('notification');
    }


    /**
     * @OA\Post(
     *      path="/public/api/users/avatar",
     *      operationId="uploadAvatar",
     *      tags={"User"},
     *      summary="upload avatar file",
     *      description="upload avatar file",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Telechargement de la photo de profil utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="avatar", type="file", format="image", example="https://image.png", description ="votre photos de profil"),   
     *  )
     *        ),
     *      ),
     *    @OA\Response(
     *      response=200,
     *      description="success",
     *      @OA\JsonContent(
     *      @OA\Property(property="avatar_path", type="string", example="users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     * @OA\Property(property="avatar_url", type="string", example="http://tchallenger.test/users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg",
     *
     *        
     * )
     *     ),
     *    @OA\Response(
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
    public function uploadAvatar(StoreUserRequest $request, User $user)
    {
        $this->authorize('uploadAvatar', $user);

        $data = UserService::uploadAvatar($request->file('avatar'));

        return response()->json($data, 200);
    }

/**
     * @OA\Put(
     *      path="/public/api/users/update-password/{id}",
     *      operationId="updatePassword",
     *      tags={"User"},
     *      summary="update password",
     *      description="update password",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      @OA\RequestBody(
     *      required=true,
     *      description="modification du mot de passe d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *    @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
     * @OA\Delete(
     *      path="/public/api/users/{id}",
     *      operationId="destroy",
     *      tags={"User"},
     *      summary="delete user",
     *      description="delete user",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
