<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use App\Services\Facades\CategorieFacade as CategorieService;

class CategorieController extends Controller
{
     /**
     * @OA\Get(
     *     path="/public/api/categories",
     *      operationId="indexx",
     *      tags={"Categorie"},
     *      summary="Get Categorie",
     *      description="Get Categorie",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage de tous les categories."),
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
        return Categorie::all();
        
    }

   /**
     * @OA\Post(
     *      path="/public/api/categories",
     *      operationId="storee",
     *      tags={"Categorie"},
     *      summary="Register new Categorie",
     *      description="Register new Categorie",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel Categorie",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="name", type="string", format="string", example="shopping", description ="votre nom de categorie"),
    
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Categorie bien Creer."),
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
    public function store(StoreCategorieRequest $request)
    {

        $this->authorize('create', Categorie::class);

        $input = $request->validated();

        $data = CategorieService::store($input);

        return $data;
    }

     /**
     * @OA\Get(
     *     path="/public/public/api/categories/{id}",
     *      operationId="showw",
     *      tags={"Categorie"},
     *      summary="Get categorie",
     *      description="Get categorie",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "categorie id",
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
     *      @OA\Property(property="message", type="string", example="affichage d'une categorie."),
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
    public function show($categorie)
    {
    //    $this->authorize('view', $categorie);

       $data = CategorieService::view($categorie);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);

    }

    /**
     * @OA\Put(
     *     path="/public/api/categories/{id}",
     *      operationId="updatee",
     *      tags={"Categorie"},
     *      summary="Update categorie",
     *      description="Update categorie",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "categorie id",
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
     *      @OA\Property(property="message", type="integer", example="1"),
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
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $this->authorize("update", $categorie);

        $input = $request->validated();

        $data = CategorieService::update($categorie, $input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

     /**
     * @OA\Delete(
     *      path="/public/api/categories/{id}",
     *      operationId="destroyy",
     *      tags={"Categorie"},
     *      summary="delete categorie",
     *      description="delete categorie",
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "categorie id",
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
     *      @OA\Property(property="message", type="string", example="suppression de la categorie reussis."),
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
    public function destroy(Categorie $categorie)
    {
        return $categorie->delete();
    }
}
