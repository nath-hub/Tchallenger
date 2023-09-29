<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionParticipationRequest;
use App\Http\Requests\UpdateActionParticipationRequest;
use App\Models\ActionParticipation;

class ActionParticipationController extends Controller
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
     * @param  \App\Http\Requests\StoreActionParticipationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActionParticipationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActionParticipation  $actionParticipation
     * @return \Illuminate\Http\Response
     */
    public function show(ActionParticipation $actionParticipation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActionParticipationRequest  $request
     * @param  \App\Models\ActionParticipation  $actionParticipation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActionParticipationRequest $request, ActionParticipation $actionParticipation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActionParticipation  $actionParticipation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionParticipation $actionParticipation)
    {
        //
    }
}
