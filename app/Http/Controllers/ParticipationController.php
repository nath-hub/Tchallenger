<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipationRequest;
use App\Http\Requests\UpdateParticipationRequest;
use App\Models\Participation;
use App\Services\Facades\ParticipationFacade as ParticipationService;
use Illuminate\Support\Facades\Auth;

class ParticipationController extends Controller
{
    
    
    /**
     * @OA\Get(
     *     path="/public/api/participations",
     *      operationId="indexxxxx",
     *      tags={"Participation"},
     *      summary="Get Participation",
     *      description="Get Participation",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage de tous les participation."),
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
    public function index()
    {
        return Participation::with("post", "user")
            ->orderBy("id")
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($participation) => [
                'id' => $participation->id,
                'titre' => $participation->title,
                'desciption' => $participation->description,
                'private' => $participation->private,
                'url_video' => $participation->url_video,
                'url_audio' => $participation->url_audio,
                'url_image' => $participation->url_image,
                'likes' => $participation->likes,
                'vues' => $participation->vues,
                'shares' => $participation->shares,
                'comments' => $participation->comments,
                'post id' => $participation->post_id,
                'post name' => $participation->post->name,
                'post start_date' => $participation->post->start_date,
                'post end_date' => $participation->post->end_date,
                'post type' => $participation->post->type,
                'post lieu' => $participation->post->lieu,
                'post price' => $participation->post->price,
                'user'=> $participation->user,
                'created_at' => $participation->created_at?->format('Y-m-d h:m:s')
            ]);
    }

   /**
     * @OA\Post(
     *      path="/public/api/participations",
     *      operationId="storeeee",
     *      tags={"Participation"},
     *      summary="Register of participation",
     *      description="Register of participation",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'une nouvelle participation",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="title", type="string", format="string", example="laporte", description ="votre titre"),
     *       @OA\Property(property="description", type="string", format="string", example="kdjfkd  kcvng", description ="votre description"),
     *       @OA\Property(property="likes", type="integer", format="1", example="1", description ="nombre de likes"),
     *       @OA\Property(property="vues", type="integer", format="1", example="1", description ="nombre de vues"),
     *       @OA\Property(property="shares", type="integer", format="1", example="1", description ="nombre de shares"),
     *       @OA\Property(property="comments", type="string", format="string", example="comments", description ="votre comments"),
     *       @OA\Property(property="post_id", type="integer", format="integer", example="3", description ="votre post_id"),
     *       @OA\Property(property="media_id", type="integer", format="integer", example="123456", description ="votre media_id"),
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="participation bien Creer."),
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
    public function store(StoreParticipationRequest $request)
    {
        $this->authorize("create", Participation::class);

        $input = $request->validated();

        $user = Auth::user();

        $participation = ParticipationService::store($input, $user);

        return $participation;
    }

    
    
   

      /**
     * @OA\Get(
     *     path="/public/api/participations/{id}",
     *      operationId="showwww",
     *      tags={"Participation"},
     *      summary="Get participation",
     *      description="Get participation",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "participation id",
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
     *      @OA\Property(property="message", type="string", example="affichage d'une participation."),
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
    public function show(Participation $participation)
    {

        $this->authorize("view",  $participation);

        return response()->json([
            [
                'id' => $participation->id,
                'titre' => $participation->title,
                'desciption' => $participation->description,
                'private' => $participation->private,
                'url_video' => $participation->url_video,
                'url_audio' => $participation->url_audio,
                'url_image' => $participation->url_image,
                'likes' => $participation->likes,
                'vues' => $participation->vues,
                'shares' => $participation->shares,
                'comments' => $participation->comments,
                'post id' => $participation->post_id,
                'post name' => $participation->post->name,
                'post start_date' => $participation->post->start_date,
                'post end_date' => $participation->post->end_date,
                'post type' => $participation->post->type,
                'post lieu' => $participation->post->lieu,
                'post price' => $participation->post->price,
                'created_at' => $participation->created_at?->format('Y-m-d h:m:s')
            ]
        ]);
    }

     /**
     * @OA\Put(
     *     path="/public/api/participations/{id}",
     *      operationId="updateeee",
     *      tags={"Participation"},
     *      summary="Update participation",
     *      description="Update participation",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "participation id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="title", type="string", format="string", example="laporte", description ="votre titre"),
     *       @OA\Property(property="description", type="string", format="string", example="kdjfkd  kcvng", description ="votre description"),
     *       @OA\Property(property="likes", type="integer", format="1", example="1", description ="nombre de likes"),
     *       @OA\Property(property="vues", type="integer", format="1", example="1", description ="nombre de vues"),
     *       @OA\Property(property="shares", type="integer", format="1", example="1", description ="nombre de shares"),
     *       @OA\Property(property="comments", type="string", format="string", example="comments", description ="votre comments"),
     *       @OA\Property(property="post_id", type="integer", format="integer", example="3", description ="votre post_id"),
     *       @OA\Property(property="media_id", type="integer", format="integer", example="123456", description ="votre media_id"),
         
     *  )
     *        ),
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
    public function update(UpdateParticipationRequest $request, Participation $participation)
    {
        $this->authorize('update', $participation);

        $input = $request->validated();

        $data = ParticipationService::update($participation, $input);

        return $data;
    }

       /**
     * @OA\Delete(
     *      path="/public/api/participations/{id}",
     *      operationId="destroyyyyy",
     *      tags={"Participation"},
     *      summary="delete participation",
     *      description="delete participation",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "participation id",
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
     *      @OA\Property(property="message", type="string", example="suppression de la participation."),
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
    public function destroy(Participation $participation)
    {
        $this->authorize('delete', $participation);

        $state = ParticipationService::delete($participation);

        return response()->json([
            "state" => $state,
            'message' => 'participation successfull delete'
        ], 202);
    }
}
