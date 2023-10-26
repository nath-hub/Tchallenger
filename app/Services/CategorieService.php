<?php

namespace App\Services;

use App\Models\Categorie;

class CategorieService
{
    public function store($input)
    {

        $state = Categorie::create($input);

        return $state;
    }

    /**
     * show a categorie
     * 
     * @param array $user The categorie data
     * 
     */
    public function view($categories)
    {

        return Categorie::find($categories);
    }

    public function update($categorie, $dataToUpdate)
    {

        return $categorie->update($dataToUpdate);
    }
}
