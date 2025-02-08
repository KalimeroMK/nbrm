<?php

namespace Kalimeromk\Nbrm\Facades;

use Illuminate\Support\Facades\Facade;
use Kalimeromk\Nbrm\NBRMExchangeService;

class NBRMExchange extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return NBRMExchangeService::class;
    }
}