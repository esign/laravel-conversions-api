<?php

namespace Esign\ConversionsApi\Tests\Support\Events;

use Esign\ConversionsApi\Contracts\MapsToFacebookPixel;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\Event;

class PurchaseEvent extends Event implements MapsToFacebookPixel
{
    public function getFacebookPixelEventType(): string
    {
        return 'track';
    }

    public function getFacebookPixelEventName(): string
    {
        return 'Purchase';
    }

    public function getFacebookPixelCustomData(): array
    {
        $customData = $this->getCustomData();

        return array_filter([
            'value' => $customData?->getValue(),
            'currency' => $customData?->getCurrency(),
            'contents' => array_map(function (Content $content) {
                return [
                    'id' => $content->getProductId(),
                    'quantity' => $content->getQuantity(),
                ];
            }, $customData?->getContents() ?? []),
        ]);
    }

    public function getFacebookPixelEventData(): array
    {
        return array_filter(['eventID' => $this->getEventId()]);
    }
}
