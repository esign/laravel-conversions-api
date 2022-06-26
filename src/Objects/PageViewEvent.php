<?php

namespace Esign\ConversionsApi\Objects;

use Esign\ConversionsApi\Facades\ConversionsApi;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Event;
use Illuminate\Support\Str;

class PageViewEvent extends Event
{
    public static function create(): self
    {
        return (new self())
            ->setActionSource(ActionSource::WEBSITE)
            ->setEventName('PageView')
            ->setEventId((string) Str::uuid())
            ->setEventTime(time())
            ->setEventSourceUrl(request()->url())
            ->setUserData(ConversionsApi::getUserData());
    }
}
