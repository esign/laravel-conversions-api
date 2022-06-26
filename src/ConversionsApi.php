<?php

namespace Esign\ConversionsApi;

use Esign\ConversionsApi\Objects\DefaultUserData;
use FacebookAds\Api;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequestAsync;
use FacebookAds\Object\ServerSide\UserData;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Collection;

class ConversionsApi
{
    protected Collection $events;
    protected UserData $userData;

    public function __construct()
    {
        $this->events = new Collection();
        $this->setUserData(DefaultUserData::create());
        Api::init(null, null, config('conversions-api.access_token'), false);
    }

    public function setUserData(UserData $userData): self
    {
        $this->userData = $userData;

        return $this;
    }

    public function getUserData(): UserData
    {
        return $this->userData;
    }

    public function addEvent(Event $event): self
    {
        $this->events->push($event);

        return $this;
    }

    public function setEvents(iterable $events): self
    {
        $this->events = new Collection($events);

        return $this;
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function clearEvents(): self
    {
        return $this->setEvents([]);
    }

    public function execute(): PromiseInterface
    {
        $eventRequest = (new EventRequestAsync(config('conversions-api.pixel_id')))
            ->setEvents($this->events);

        if ($testCode = config('conversions-api.test_code')) {
            $eventRequest->setTestEventCode($testCode);
        }

        $this->clearEvents();

        return $eventRequest->execute();
    }
}
