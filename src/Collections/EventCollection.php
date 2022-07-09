<?php

namespace Esign\ConversionsApi\Collections;

use Esign\ConversionsApi\Contracts\MapsToDataLayer;
use Esign\ConversionsApi\Contracts\MapsToFacebookPixel;
use Illuminate\Support\Collection;

class EventCollection extends Collection
{
    public function getFacebookPixelEvents(): static
    {
        return $this->filter(fn ($event) => $event instanceof MapsToFacebookPixel);
    }

    public function getDataLayerEvents(): static
    {
        return $this->filter(fn ($event) => $event instanceof MapsToDataLayer);
    }
}
