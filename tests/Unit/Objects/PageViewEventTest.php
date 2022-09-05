<?php

namespace Esign\ConversionsApi\Tests\Unit\Objects;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\Objects\PageViewEvent;
use Esign\ConversionsApi\Tests\TestCase;
use FacebookAds\Object\ServerSide\ActionSource;
use Illuminate\Support\Str;

class PageViewEventTest extends TestCase
{
    /** @test */
    public function it_can_statically_create_itself()
    {
        $this->get('posts?title=abc');
        Str::createUuidsUsing(fn () => 'b13ddf8f-df2d-4554-9ae6-a1a73861b0ad');

        $event = PageViewEvent::create();

        $this->assertEquals(ActionSource::WEBSITE, $event->getActionSource());
        $this->assertEquals('PageView', $event->getEventName());
        $this->assertEquals('b13ddf8f-df2d-4554-9ae6-a1a73861b0ad', $event->getEventId());
        $this->assertEquals(ConversionsApi::getUserData(), $event->getUserData());
        $this->assertEquals('http://localhost/posts?title=abc', $event->getEventSourceUrl());
    }
}