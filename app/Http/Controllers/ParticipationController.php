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
     * Display a listing of the resource.
     *
     * @return string
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParticipationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipationRequest $request)
    {
        $this->authorize("create", Participation::class);

        $input = $request->validated();

        $participation = ParticipationService::store($input);

        return $participation;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participation  $participation
     * @return string
     */
    public function voteParticipation()
    {
        $this->authorize("voteParticipation", Participation::class);

        $participation = ParticipationService::vote();

        return $participation;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participation  $participation
     * @return string
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipationRequest  $request
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipationRequest $request, Participation $participation)
    {
        $this->authorize('update', $participation);

        $input = $request->validated();

        $data = ParticipationService::update($participation, $input);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participation  $participation
     * @return string
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
