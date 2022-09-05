<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Contracts\MapsToDataLayer;
use Illuminate\View\Component;

class DataLayerVariable extends Component
{
    public function __construct(
        protected MapsToDataLayer $event
    ) {
    }

    public function render()
    {
        return view('conversions-api::components.data-layer-variable', [
            'arguments' => $this->event->getDataLayerArguments(),
        ]);
    }
}
