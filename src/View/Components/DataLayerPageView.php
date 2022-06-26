<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\Objects\PageViewEvent;

class DataLayerPageView extends DataLayerVariable
{
    public function __construct(string $dataLayerVariableName = 'conversionsApiPageViewEventId')
    {
        $pageViewEvent = PageViewEvent::create();
        ConversionsApi::addEvent($pageViewEvent)->sendEvents();

        parent::__construct(
            $dataLayerVariableName,
            $pageViewEvent->getEventId()
        );
    }
}
