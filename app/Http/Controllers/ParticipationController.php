<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipationRequest;
use App\Http\Requests\UpdateParticipationRequest;
use App\Models\Participation;

class ParticipationController extends Controller
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
     * @param  \App\Http\Requests\StoreParticipationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function show(Participation $participation)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participation  $participation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participation $participation)
    {
        //
    }
}
