<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Parameter;
use App\Services\Facades\ParameterFacade as ParameterService;
use Illuminate\Support\Facades\Auth;


class ParameterController extends Controller
{

    /**
 * @OA\SecuritySheme(
 * securitySheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="JWT"
 * )
 */

    /**
     * @OA\Get(
     *     path="/public/api/parametres",
     *      operationId="indexxxx",
     *      tags={"Parameter"},
     *      summary="Get parameter",
     *      description="Get parameter",
     *      security={{"bearerAuth": {{}}}},
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage des parameters."),
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
     * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
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
        return Parameter::all();
    }

      /**
     * @OA\Post(
     *      path="/public/api/parametres",
     *      operationId="storeeeee",
     *      tags={"Parameter"},
     *      summary="create Parameter",
     *      description="create Parameter",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel Parameter",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="color", type="string", format="string", example="laporte", description ="votre login"),
     *       @OA\Property(property="notif_abonnement", type="boolean", format="1", example="1", description ="notification abonnement"),
     *       @OA\Property(property="notif_challenge", type="boolean", format="1", example="1", description ="notification challenge"),
     *       @OA\Property(property="notif_comment", type="boolean", format="1", example="1", description ="notification comment"),
     *       @OA\Property(property="notif_publication", type="boolean", format="1", example="1", description ="notification publication"),
     *       @OA\Property(property="notif_message", type="boolean", format="1", example="1", description ="notification message"),
     *       @OA\Property(property="langue", type="string", format="string", example="fr", description ="votre langue"),
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Parametre bien Creer."),
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
     *    @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
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
    public function store(StoreParameterRequest $request)
    {
        $this->authorize('create', Parameter::class);

        $input = $request->validated();

        $data = ParameterService::create($input);

        return  $data;
    }

   /**
     * @OA\Get(
     *     path="/public/api/parametres/{id}",
     *      operationId="showww",
     *      tags={"Parameter"},
     *      summary="Get parameter",
     *      description="Get parameter",
     *      security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "parameter id",
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
     *      @OA\Property(property="message", type="string", example="affichage d'un parameter."),
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
     *  * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
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
    public function show(Parameter $parameter)
    {        
        $user = Auth::user();

        $this->authorize("view",  [$user, $parameter]);

        $data = ParameterService::view($parameter);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

       /**
     * @OA\Put(
     *     path="/public/api/parametres/{id}",
     *      operationId="updateee",
     *      tags={"Parameter"},
     *      summary="Update parameter",
     *      description="Update parameter",
     *      security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "parameter id",
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
     *  * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
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
    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        $user = Auth::user();

        $this->authorize('update', [$user, $parameter]);

        $input = $request->validated();

        $data = ParameterService::update($parameter, $input);

        return $data;
    }

     /**
     * @OA\Delete(
     *      path="/public/api/parametres/{id}",
     *      operationId="destroyyy",
     *      tags={"Parameter"},
     *      summary="delete parameter",
     *      description="delete parameter",
     *      security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "parameter id",
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
     *      @OA\Property(property="message", type="string", example="suppression du parameter."),
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
     *  * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
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
    public function destroy(Parameter $parameter)
    {
        $user = Auth::user();

        $this->authorize('delete', [$user, $parameter]);

        $data = ParameterService::delete($parameter);

        return $data;
    }
}
