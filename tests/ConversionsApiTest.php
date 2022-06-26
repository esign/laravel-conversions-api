<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\Facades\ConversionsApi;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\UserData;

class ConversionsApiTest extends TestCase
{
    /** @test */
    public function it_can_set_user_data_by_default()
    {
        request()->headers->set('USER_AGENT', 'Esign Agent');
        request()->server->set('REMOTE_ADDR', '0.0.0.0');

        $this->assertEquals('0.0.0.0', ConversionsApi::getUserData()->getClientIpAddress());
        $this->assertEquals('Esign Agent', ConversionsApi::getUserData()->getClientUserAgent());
    }

    /** @test */
    public function it_can_set_user_data()
    {
        ConversionsApi::setUserData(
            (new UserData())->setFirstName('John')->setLastName('Doe')
        );

        $this->assertEquals('John', ConversionsApi::getUserData()->getFirstName());
        $this->assertEquals('Doe', ConversionsApi::getUserData()->getLastName());
    }

    /** @test */
    public function it_can_add_an_event()
    {
        ConversionsApi::addEvent(
            (new Event())->setEventName('PageView')->setEventId('abc')
        );

        $this->assertCount(1, ConversionsApi::getEvents());
        $this->assertEquals('PageView', ConversionsApi::getEvents()->first()->getEventName());
        $this->assertEquals('abc', ConversionsApi::getEvents()->first()->getEventId());
    }

    /** @test */
    public function it_can_set_an_array_of_events()
    {
        ConversionsApi::setEvents([
            (new Event())->setEventName('PageView')->setEventId('abc'),
        ]);

        $this->assertCount(1, ConversionsApi::getEvents());
        $this->assertEquals('PageView', ConversionsApi::getEvents()->first()->getEventName());
        $this->assertEquals('abc', ConversionsApi::getEvents()->first()->getEventId());
    }

    /** @test */
    public function it_can_clear_events()
    {
        ConversionsApi::setEvents([
            (new Event())->setEventName('PageView')->setEventId('abc'),
        ]);

        ConversionsApi::clearEvents();

        $this->assertCount(0, ConversionsApi::getEvents());
    }
}
