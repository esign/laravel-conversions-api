<?php

namespace Esign\ConversionsApi\View\Components;

use Illuminate\View\Component;

class FacebookPixelTrackingEvent extends Component
{
    protected string $eventType;
    protected string $eventName;
    protected array $customData;
    protected array $eventData;

    public function __construct(
        string $eventType,
        string $eventName,
        array $customData = [],
        array $eventData = [],
    ) {
        $this->eventType = $eventType;
        $this->eventName = $eventName;
        $this->customData = $customData;
        $this->eventData = $eventData;
    }

    public function render()
    {
        return view('conversions-api::components.facebook-pixel-tracking-event', [
            'eventType' => $this->eventType,
            'eventName' => $this->eventName,
            'customData' => $this->customData,
            'eventData' => $this->eventData,
        ]);
    }
}
