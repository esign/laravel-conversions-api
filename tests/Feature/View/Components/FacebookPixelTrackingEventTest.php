<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use PHPUnit\Framework\Attributes\Test;
use Esign\ConversionsApi\Tests\Support\Events\PurchaseEvent;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelTrackingEvent;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

final class FacebookPixelTrackingEventTest extends TestCase
{
    use InteractsWithViews;

    #[Test]
    public function it_can_render_the_view(): void
    {
        $event = (new PurchaseEvent());
        $component = $this->component(FacebookPixelTrackingEvent::class, [
            'event' => $event,
        ]);

        $component->assertSee('track');
        $component->assertSee('Purchase');
    }

    #[Test]
    public function it_can_encode_custom_data_and_event_data_as_objects_when_they_are_empty_arrays(): void
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

    #[Test]
    public function it_can_json_encode_custom_data_and_event_data(): void
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

    #[Test]
    public function it_can_render_anonymously(): void
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

    #[Test]
    public function it_can_pass_component_attributes(): void
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
