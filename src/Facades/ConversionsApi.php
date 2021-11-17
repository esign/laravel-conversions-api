<?php

namespace Esign\ConversionsApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Esign\ConversionsApi\ConversionsApi
 */
class ConversionsApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Esign\ConversionsApi\ConversionsApi::class;
    }
}
