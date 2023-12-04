<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Tests\Support\Events\PurchaseEvent;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelTrackingEvent;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class FacebookPixelTrackingEventTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        $event = (new PurchaseEvent());
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'event' => $event,
        ]);

        $component->assertSee('track');
        $component->assertSee('Purchase');
    }

    /** @test */
    public function it_can_encode_custom_data_and_event_data_as_objects_when_they_are_empty_arrays()
    {
        $event = (new PurchaseEvent());
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'event' => $event,
        ]);

        $component->assertSee(
            "fbq('track', 'Purchase', {}, {});",
            false
        );
    }

    /** @test */
    public function it_can_json_encode_custom_data_and_event_data()
    {
        $contents = (new Content())->setProductId('10')->setQuantity(2);
        $customData = (new CustomData())->setValue(120)->setCurrency('GBP')->setContents([$contents]);
        $event = (new PurchaseEvent())->setCustomData($customData)->setEventId('123');
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'event' => $event,
        ]);

        $component->assertSee(
            "fbq('track', 'Purchase', {\"value\":120,\"currency\":\"GBP\",\"contents\":[{\"id\":\"10\",\"quantity\":2}]}, {\"eventID\":\"123\"});",
            false
        );
    }

    /** @test */
    public function it_can_render_anonymously()
    {
        $view = $this->blade('
            <x-conversions-api::facebook-pixel-tracking-event
                eventType="track"
                eventName="Purchase"
                :customData="[]"
                :eventData="[]"
            />
        ');

        $view->assertSee("fbq('track', 'Purchase', {}, {});", false);
    }

    /** @test */
    public function it_can_pass_component_attributes()
    {
        $view = $this->blade('
            <x-conversions-api::facebook-pixel-tracking-event
                eventType="track"
                eventName="Purchase"
                :customData="[]"
                :eventData="[]"
                class="my-class"
            />
        ');

        $view->assertSee('<script class="my-class">', false);
    }
}
