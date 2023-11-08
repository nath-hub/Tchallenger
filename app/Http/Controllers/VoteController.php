<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Vote;
use App\Services\Facades\VoteFacade as VoteService;
use Auth;

class VoteController extends Controller
{
  
    /**
     * @OA\Get(
     *     path="/public/api/votes",
     *      operationId="indexxxxxxx",
     *      tags={"Vote"},
     *      summary="Get Vote",
     *      description="Get Vote",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage des votes."),
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

        $vote = Vote::latest()->paginate(10);

        return $vote;
    }

      /**
     * @OA\Post(
     *      path="/public/api/votes",
     *      operationId="storeeeeeeee",
     *      tags={"Vote"},
     *      summary="Register of vote",
     *      description="Register of vote",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouveau vote",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="participation_id", type="integer", format="integer", example="1", description ="identifiant de la participation en question"),
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Vote bien Creer ou vote bien supprimer."),
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
    public function store(StoreVoteRequest $request)
    {
        $this->authorize("create", Vote::class);

        $input = $request->validated();

        $user = Auth::user();

        $vote = VoteService::vote($input, $user);

        return $vote;
    }

     /**
     * @OA\Get(
     *     path="/public/api/votes/{id}",
     *      operationId="showws",
     *      tags={"Vote"},
     *      summary="Get vote",
     *      description="Get vote",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "vote id",
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
     *      @OA\Property(property="message", type="string", example="affichage d'un vote."),
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
    public function show(Vote $vote)
    {
        $this->authorize("view", $vote);

        $vote = VoteService::view($vote);

        return $vote;
    }

      /**
     * @OA\Put(
     *     path="/public/api/votes/{id}",
     *      operationId="updateeeeeeeeee",
     *      tags={"Vote"},
     *      summary="Update Vote",
     *      description="Update Vote",
     *  security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "Vote id",
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
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        $this->authorize("update", $vote);

        $input = $request->validated();

        $vote = VoteService::update($vote, $input);

        return $vote;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
