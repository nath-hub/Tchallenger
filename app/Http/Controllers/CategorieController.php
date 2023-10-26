<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use App\Services\Facades\CategorieFacade as CategorieService;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return Categorie::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieRequest $request)
    {

        $this->authorize('create', Categorie::class);

        $input = $request->validated();

        $data = CategorieService::store($input);

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return string
     */
    public function show($categorie)
    {
    //    $this->authorize('view', $categorie);

       $data = CategorieService::view($categorie);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieRequest  $request
     * @param  \App\Models\Categorie  $categorie
     * @return string
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $this->authorize("update", $categorie);

        $input = $request->validated();

        $data = CategorieService::update($categorie, $input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
