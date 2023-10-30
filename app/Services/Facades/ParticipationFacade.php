<?php

namespace App\Services\Facades;

use App\Services\ParticipationService;
use Illuminate\Support\Facades\Facade;

class ParticipationFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return ParticipationService::class;
     }

}