<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Illuminate\Support\Facades\Blade;

class BladeTest extends TestCase
{
    /** @test */
    public function it_can_render_the_conversions_api_page_view_directive()
    {
        ConversionsApi::shouldReceive('executePageViewEvent')->once();
        Blade::compileString('@conversionsApiPageView');
    }

    /** @test */
    public function it_can_render_the_conversions_api_data_layer_view()
    {
        ConversionsApi::setEventId('my-event-id');
        $this->assertStringContainsString(
            'my-event-id',
            view('conversions-api::data-layer')->render()
        );
    }
}
