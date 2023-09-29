<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbonnementRequest;
use App\Http\Requests\UpdateAbonnementRequest;
use App\Models\Abonnement;

class AbonnementController extends Controller
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
     * @param  \App\Http\Requests\StoreAbonnementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbonnementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function show(Abonnement $abonnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbonnementRequest  $request
     * @param  \App\Models\Abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbonnementRequest $request, Abonnement $abonnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abonnement $abonnement)
    {
        //
    }
}
