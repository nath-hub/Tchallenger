<?php

namespace App\Services\Facades;

use App\Services\VoteService;
use Illuminate\Support\Facades\Facade;

class VoteFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return VoteService::class;
     }

}
