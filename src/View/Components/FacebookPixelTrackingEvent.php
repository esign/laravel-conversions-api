<?php

namespace Esign\ConversionsApi\View\Components;

use Illuminate\View\Component;

class FacebookPixelTrackingEvent extends Component
{
    protected string $command;
    protected string $eventName;
    protected array $data;
    protected array $parameters;

    public function __construct(
        string $command = 'track',
        string $eventName,
        array $data = [],
        array $parameters = [],
    ) {
        $this->command = $command;
        $this->eventName = $eventName;
        $this->data = $data;
        $this->parameters = $parameters;
    }

    public function render()
    {
        return view('conversions-api::components.facebook-pixel-tracking-event', [
            'command' => $this->command,
            'eventName' => $this->eventName,
            'data' => $this->data,
            'parameters' => $this->parameters,
        ]);
    }
}
