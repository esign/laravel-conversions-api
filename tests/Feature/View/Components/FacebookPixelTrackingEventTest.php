<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelTrackingEvent;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class FacebookPixelTrackingEventTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'command' => 'track',
            'eventName' => 'Purchase',
        ]);

        $component->assertSee('track');
        $component->assertSee('Purchase');
    }

    /** @test */
    public function it_can_encode_data_and_parameters_as_objects_when_they_are_empty_arrays()
    {
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'command' => 'track',
            'eventName' => 'Purchase',
            'data' => [],
            'parameters' => [],
        ]);

        $component->assertSee(
            "fbq('track', 'Purchase', {}, {});",
            false
        );
    }

    /** @test */
    public function it_can_json_encode_data_and_parameters()
    {
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'command' => 'track',
            'eventName' => 'Purchase',
            'data' => ['price' => 120],
            'parameters' => ['eventID' => '123'],
        ]);

        $component->assertSee(
            "fbq('track', 'Purchase', {\"price\":120}, {\"eventID\":\"123\"});",
            false
        );
    }
}
