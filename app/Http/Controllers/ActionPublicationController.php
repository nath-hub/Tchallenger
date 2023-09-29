<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionPublicationRequest;
use App\Http\Requests\UpdateActionPublicationRequest;
use App\Models\ActionPublication;

class ActionPublicationController extends Controller
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
     * @param  \App\Http\Requests\StoreActionPublicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActionPublicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActionPublication  $actionPublication
     * @return \Illuminate\Http\Response
     */
    public function show(ActionPublication $actionPublication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActionPublicationRequest  $request
     * @param  \App\Models\ActionPublication  $actionPublication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActionPublicationRequest $request, ActionPublication $actionPublication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActionPublication  $actionPublication
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionPublication $actionPublication)
    {
        //
    }
}
