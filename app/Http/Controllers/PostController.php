<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\Facades\PostFacade as PostService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *      operationId="indexxxxxx",
     *      tags={"Post"},
     *      summary="Get Post",
     *      description="Get Post",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un Post."),
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
    public function index():Paginator
    {
        return Post::with('categorie')
            ->orderBy('id') 
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($post) => [
                'id' => $post->id,
                'titre' => $post->title,
                'desciption' => $post->description,
                'stard date' => $post->start_date,
                'end_date' => $post->end_date,
                'type' => $post->type,
                'lieu' => $post->lieu,
                'price' => $post->price,
                'private' => $post->private,
                'url_video' => $post->url_video,
                'url_audio' => $post->url_audio,
                'url_image' => $post->url_image,
                'likes' => $post->likes,
                'vues' => $post->vues,
                'shares' => $post->shares,
                'comments' => $post->comments,
                'categorie id' => $post->categorie->id,
                'categorie name' => $post->categorie->name,
               'created_at' => $post->created_at?->format('Y-m-d h:m:s')
            ]);
    }

     /**
     * @OA\Post(
     *      path="/api/posts",
     *      operationId="storeeeeee",
     *      tags={"Post"},
     *      summary="Register of post",
     *      description="Register of post",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouveau post",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
      *       @OA\Property(property="title", type="string", format="string", example="laporte", description ="votre titre"),
     *       @OA\Property(property="description", type="string", format="string", example="kdjfkd  kcvng", description ="votre description"),
     *      @OA\Property(property="start_date", type="date", format="date", example="2023-11-06 09:57:50", description ="votre date de debut"),
     *      @OA\Property(property="end_date", type="date", format="date", example="2023-11-06 09:57:50", description ="votre date de fin"),
     *      @OA\Property(property="type", type="string", format="string", example="CHALLENGE/PUBLICATION", description ="votre type"),
     *      @OA\Property(property="lieu", type="string", format="string", example="paris", description ="votre lieu"),
     *      @OA\Property(property="price", type="integer", format="integer", example="8", description ="votre price"),
     *      @OA\Property(property="private", type="boolean", format="string", example="1", description ="etant de votre post"),
     *       @OA\Property(property="likes", type="integer", format="1", example="1", description ="nombre de likes"),
     *       @OA\Property(property="vues", type="integer", format="1", example="1", description ="nombre de vues"),
     *       @OA\Property(property="shares", type="integer", format="1", example="1", description ="nombre de shares"),
     *       @OA\Property(property="comments", type="string", format="string", example="comments", description ="votre comments"),
     *       @OA\Property(property="categorie_id", type="integer", format="integer", example="3", description ="votre categorie_id"),
     *       @OA\Property(property="media_id", type="integer", format="integer", example="123456", description ="votre media_id"),
         
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Post bien Creer."),
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
    public function store(StorePostRequest $request)
    {
        $this->authorize("create", Post::class);

        $user = Auth::user();

        $input = $request->validated();

        $data = PostService::store($input, $user);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

      /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *      operationId="showwwwww",
     *      tags={"Post"},
     *      summary="Get post",
     *      description="Get post",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "post id",
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
     *      @OA\Property(property="message", type="string", example="affichage d'un post."),
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
    public function show(Post $post)
    {
        $this->authorize("view",  $post);

        PostService::view($post);

        return response()->json([
            [
                'id' => $post->id,
                'titre' => $post->title,
                'desciption' => $post->description,
                'stard date' => $post->start_date,
                'end_date' => $post->end_date,
                'type' => $post->type,
                'lieu' => $post->lieu,
                'price' => $post->price,
                'private' => $post->private,
                'url_video' => $post->url_video,
                'url_audio' => $post->url_audio,
                'url_image' => $post->url_image,
                'likes' => $post->likes,
                'vues' => $post->vues,
                'shares' => $post->shares,
                'comments' => $post->comments,
                'categorie id' => $post->categorie->id,
                'categorie name' => $post->categorie->name,
               'created_at' => $post->created_at?->format('Y-m-d h:m:s')
            ]
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *      operationId="updateeeeeee",
     *      tags={"Post"},
     *      summary="Update post",
     *      description="Update post",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "post id",
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
    public function update(UpdatePostRequest $requests, Post $post)
    {
        $user = Auth::user();

        $this->authorize('update', [$user, $post]);

        $input = $requests->validated();

        $data = PostService::update($post, $input);

        return $data;
    }

      /**
     * @OA\Delete(
     *      path="/api/posts/{id}",
     *      operationId="destroyyyyyyy",
     *      tags={"Post"},
     *      summary="delete post",
     *      description="delete post",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "post id",
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
     *      @OA\Property(property="message", type="string", example="suppression d'un post."),
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
    public function destroy(Post $post)
    {   
        $user = Auth::user();

        $this->authorize('delete', [$user, $post]);

        $data = PostService::delete($post);

        return response()->json([
            "state" => $data,
            'message' => 'users successfull delete'
        ], 202);
    }

    
}
