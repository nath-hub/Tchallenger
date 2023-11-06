<?php

namespace App\Services\Facades;

use App\Services\MediaService;
use Illuminate\Support\Facades\Facade;

class MediaFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return MediaService::class;
     }

}