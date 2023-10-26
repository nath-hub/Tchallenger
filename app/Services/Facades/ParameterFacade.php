<?php

namespace App\Services\Facades;

use App\Services\ParameterService;
use Illuminate\Support\Facades\Facade;

class ParameterFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return ParameterService::class;
     }

}
