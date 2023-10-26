<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRelationshipsRequest;
use App\Http\Requests\UpdateRelationshipsRequest;
use App\Models\Relationships;

class RelationshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelationshipsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Relationships $relationships)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelationshipsRequest $request, Relationships $relationships)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relationships $relationships)
    {
        //
    }
}
