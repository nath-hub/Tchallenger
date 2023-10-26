<?php

namespace App\Services\Facades;

use App\Services\CategorieService;
use Illuminate\Support\Facades\Facade;

class CategorieFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return CategorieService::class;
     }

}
