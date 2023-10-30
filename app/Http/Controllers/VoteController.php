<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Participation;
use App\Models\Vote;
use App\Services\Facades\VoteFacade as VoteService;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vote = Vote::latest()->paginate(10);

        return $vote;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoteRequest $request)
    {
        $this->authorize("create", Vote::class);

        $input = $request->validated();

        $vote = VoteService::vote($input);

        return $vote;
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        $this->authorize("view", $vote);

        $vote = VoteService::view($vote);

        return $vote;
    }

    /**
     * Update the specified resource in storage.
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
