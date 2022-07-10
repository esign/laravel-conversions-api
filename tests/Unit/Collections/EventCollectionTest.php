<?php

namespace Esign\ConversionsApi\Tests\Unit\Collections;

use Esign\ConversionsApi\Collections\EventCollection;
use Esign\ConversionsApi\Tests\Support\Events\ContactEvent;
use Esign\ConversionsApi\Tests\Support\Events\PurchaseEvent;
use Esign\ConversionsApi\Tests\TestCase;

class EventCollectionTest extends TestCase
{
    /** @test */
    public function it_can_filter_facebook_pixel_events()
    {
        $eventCollection = new EventCollection([
            $purchaseEvent = new PurchaseEvent(),
            $contactEvent = new ContactEvent(),
        ]);

        $facebookPixelEvents = $eventCollection->filterFacebookPixelEvents();

        $this->assertTrue($facebookPixelEvents->contains($purchaseEvent));
        $this->assertFalse($facebookPixelEvents->contains($contactEvent));
    }

    /** @test */
    public function it_can_filter_data_layer_events()
    {
        $eventCollection = new EventCollection([
            $purchaseEvent = new PurchaseEvent(),
            $contactEvent = new ContactEvent(),
        ]);

        $dataLayerEvents = $eventCollection->filterDataLayerEvents();

        $this->assertFalse($dataLayerEvents->contains($purchaseEvent));
        $this->assertTrue($dataLayerEvents->contains($contactEvent));
    }
}
