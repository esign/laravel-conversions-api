<?php

namespace Esign\ConversionsApi\Tests\Unit\Collections;

use Esign\ConversionsApi\Collections\EventCollection;
use Esign\ConversionsApi\Tests\Support\Events\ContactEvent;
use Esign\ConversionsApi\Tests\Support\Events\PurchaseEvent;
use Esign\ConversionsApi\Tests\TestCase;

class EventCollectionTest extends TestCase
{
    /** @test */
    public function it_can_get_facebook_pixel_events()
    {
        $eventCollection = new EventCollection([
            $purchaseEvent = new PurchaseEvent(),
            $contactEvent = new ContactEvent(),
        ]);

        $facebookPixelEvents = $eventCollection->getFacebookPixelEvents();

        $this->assertTrue($facebookPixelEvents->contains($purchaseEvent));
        $this->assertFalse($facebookPixelEvents->contains($contactEvent));
    }

    /** @test */
    public function it_can_get_data_layer_events()
    {
        $eventCollection = new EventCollection([
            $purchaseEvent = new PurchaseEvent(),
            $contactEvent = new ContactEvent(),
        ]);

        $dataLayerEvents = $eventCollection->getDataLayerEvents();

        $this->assertFalse($dataLayerEvents->contains($purchaseEvent));
        $this->assertTrue($dataLayerEvents->contains($contactEvent));
    }
}
