<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Contracts\MapsToFacebookPixel;
use Illuminate\View\Component;

class FacebookPixelTrackingEvent extends Component
{
    public function __construct(
        protected MapsToFacebookPixel $event
    ) {
    }

    public function render()
    {
        return view('conversions-api::components.facebook-pixel-tracking-event', [
            'eventType' => $this->event->getFacebookPixelEventType(),
            'eventName' => $this->event->getFacebookPixelEventName(),
            'customData' => $this->event->getFacebookPixelCustomData(),
            'eventData' => $this->event->getFacebookPixelEventData(),
        ]);
    }
}
