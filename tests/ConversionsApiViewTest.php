<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class ConversionsApiViewTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_data_layer_view()
    {
        $view = $this->view('conversions-api::data-layer');
        $view->assertSee(ConversionsApi::getEventId());
    }
}
