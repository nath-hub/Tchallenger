<?php

namespace App\Services\Facades;

use App\Services\ActionService;
use Illuminate\Support\Facades\Facade;

class ActionFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return ActionService::class;
     }

}
