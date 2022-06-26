<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\DataLayerVariable;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class DataLayerVariableTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        $component = $this->component(DataLayerVariable::class, [
            'name' => 'data-layer-variable-name',
            'value' => 'data-layer-variable-value',
        ]);

        $component->assertSee(
            "window.dataLayer.push({'data-layer-variable-name': 'data-layer-variable-value'});",
            false
        );
    }
}
