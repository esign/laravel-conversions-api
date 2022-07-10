<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\Objects\PageViewEvent;

class FacebookPixelPageView extends FacebookPixelTrackingEvent
{
    public function __construct()
    {
        $pageViewEvent = PageViewEvent::create();
        ConversionsApi::clearEvents()->addEvent($pageViewEvent)->sendEvents();

        parent::__construct($pageViewEvent);
    }
}
