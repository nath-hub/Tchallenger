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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
