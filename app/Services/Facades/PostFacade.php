<?php

namespace App\Services\Facades;

use App\Services\PostService;
use Illuminate\Support\Facades\Facade;

class PostFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return PostService::class;
     }

}
