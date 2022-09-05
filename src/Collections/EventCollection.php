<?php

namespace Esign\ConversionsApi\Collections;

use Esign\ConversionsApi\Contracts\MapsToDataLayer;
use Esign\ConversionsApi\Contracts\MapsToFacebookPixel;
use Illuminate\Support\Collection;

class EventCollection extends Collection
{
    public function filterFacebookPixelEvents(): static
    {
        return $this->filter(fn ($event) => $event instanceof MapsToFacebookPixel);
    }

    public function filterDataLayerEvents(): static
    {
        return $this->filter(fn ($event) => $event instanceof MapsToDataLayer);
    }
}
