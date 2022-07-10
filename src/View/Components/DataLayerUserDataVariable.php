<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Contracts\MapsToDataLayer;
use Esign\ConversionsApi\Facades\ConversionsApi;

class DataLayerUserDataVariable extends DataLayerVariable implements MapsToDataLayer
{
    public function __construct()
    {
        parent::__construct($this);
    }

    public function getDataLayerArguments(): array
    {
        $userData = ConversionsApi::getUserData();

        return array_filter([
            'conversionsApiEmail' => $userData->getEmail(),
            'conversionsApiFirstName' => $userData->getFirstName(),
            'conversionsApiLastName' => $userData->getLastName(),
            'conversionsApiPhone' => $userData->getPhone(),
            'conversionsApiExternalId' => $userData->getExternalId(),
            'conversionsApiGender' => $userData->getGender(),
            'conversionsApiDateOfBirth' => $userData->getDateOfBirth(),
            'conversionsApiCity' => $userData->getCity(),
            'conversionsApiState' => $userData->getState(),
            'conversionsApiZipCode' => $userData->getZipCode(),
            'conversionsApiCountry' => $userData->getCountryCode(),
        ]);
    }
}