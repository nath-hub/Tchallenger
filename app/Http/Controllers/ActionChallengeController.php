<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionChallengeRequest;
use App\Http\Requests\UpdateActionChallengeRequest;
use App\Models\ActionChallenge;

class ActionChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActionChallengeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActionChallengeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActionChallenge  $actionChallenge
     * @return \Illuminate\Http\Response
     */
    public function show(ActionChallenge $actionChallenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActionChallengeRequest  $request
     * @param  \App\Models\ActionChallenge  $actionChallenge
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActionChallengeRequest $request, ActionChallenge $actionChallenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActionChallenge  $actionChallenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionChallenge $actionChallenge)
    {
        //
    }
}
