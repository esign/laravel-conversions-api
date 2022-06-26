<?php

namespace Esign\ConversionsApi\View\Components;

use Illuminate\View\Component;

class DataLayerVariable extends Component
{
    protected string $name;
    protected mixed $value;

    public function __construct(string $name, mixed $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('conversions-api::components.data-layer-variable', [
            'name' => $this->name,
            'value' => $this->value,
        ]);
    }
}
