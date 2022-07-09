<?php

namespace Esign\ConversionsApi\Tests\Support\Events;

use Esign\ConversionsApi\Contracts\MapsToDataLayer;
use FacebookAds\Object\ServerSide\Event;

class ContactEvent extends Event implements MapsToDataLayer
{
    public function getDataLayerArguments(): array
    {
        return [
            'event' => 'Contact',
            'conversionsApiContactEventId' => $this->getEventId(),
        ];
    }
}
