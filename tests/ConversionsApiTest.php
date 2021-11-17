<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\Facades\ConversionsApi;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Support\Str;

class ConversionsApiTest extends TestCase
{
    /** @test */
    public function it_can_set_a_uuid_as_default_event_id()
    {
        $this->assertTrue(Str::isUuid(ConversionsApi::getEventId()));
    }

    /** @test */
    public function it_can_set_an_event_id()
    {
        ConversionsApi::setEventId('abc');

        $this->assertEquals('abc', ConversionsApi::getEventId());
    }

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
    public function it_wont_have_an_event_by_default()
    {
        $this->assertNull(ConversionsApi::getEvent());
    }

    /** @test */
    public function it_can_set_an_event()
    {
        ConversionsApi::setEvent(
            (new Event())->setEventName('PageView')->setEventId('abc')
        );

        $this->assertEquals('PageView', ConversionsApi::getEvent()->getEventName());
        $this->assertEquals('abc', ConversionsApi::getEvent()->getEventId());
    }

    /** @test */
    public function it_can_set_an_event_by_name()
    {
        request()->headers->set('HOST', 'www.esign.eu');
        request()->server->set('HTTPS', true);
        ConversionsApi::setEventByName('Contact');

        $this->assertEquals('Contact', ConversionsApi::getEvent()->getEventName());
        $this->assertEquals('website', ConversionsApi::getEvent()->getActionSource());
        $this->assertEquals('https://www.esign.eu', ConversionsApi::getEvent()->getEventSourceUrl());
    }
}
