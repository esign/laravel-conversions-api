<?php

namespace Esign\ConversionsApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self setUserData(\FacebookAds\Object\ServerSide\UserData $userData)
 * @method static \FacebookAds\Object\ServerSide\UserData getUserData()
 * @method static self addEvent(\FacebookAds\Object\ServerSide\Event $event)
 * @method static self addEvents(iterable $events)
 * @method static self setEvents(iterable $events)
 * @method static \Illuminate\Support\Collection getEvents()
 * @method static self clearEvents()
 * @method static \GuzzleHttp\Promise\PromiseInterface sendEvents()
 *
 * @see \Esign\ConversionsApi\ConversionsApi
 */
class ConversionsApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Esign\ConversionsApi\ConversionsApi::class;
    }
}
