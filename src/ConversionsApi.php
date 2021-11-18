<?php

namespace Esign\ConversionsApi;

use FacebookAds\Api;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequestAsync;
use FacebookAds\Object\ServerSide\UserData;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConversionsApi
{
    protected Request $request;
    protected UserData $userData;
    protected ?Event $event = null;
    protected string $eventId;

    public function __construct()
    {
        $this->request = request();
        $this->userData = $this->getDefaultUserData();
        $this->eventId = (string) Str::uuid();
        Api::init(null, null, config('conversions-api.access_token'), false);
    }

    protected function getDefaultUserData(): UserData
    {
        return (new UserData())
            ->setClientIpAddress($this->request->ip())
            ->setClientUserAgent($this->request->userAgent());
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

    public function setEvent(Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function setEventId(string $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function setEventByName(string $eventName): self
    {
        $event = (new Event())
            ->setActionSource('website')
            ->setEventName($eventName)
            ->setEventId($this->getEventId())
            ->setEventTime(time())
            ->setEventSourceUrl($this->request->url())
            ->setUserData($this->userData);

        return $this->setEvent($event);
    }

    public function execute(): PromiseInterface
    {
        $eventRequest = (new EventRequestAsync(config('conversions-api.pixel_id')))
            ->setEvents([$this->event]);

        if ($testCode = config('conversions-api.test_code')) {
            $eventRequest->setTestEventCode($testCode);
        }

        return $eventRequest->execute();
    }

    public function executePageViewEvent(): PromiseInterface
    {
        return $this->setEventByName('PageView')->execute();
    }
}
