<?php

return [
    /**
     * The access token used by the Conversions API.
     */
    'access_token' => env('CONVERSIONS_API_ACCESS_TOKEN'),

    /**
     * The pixel ID used by the Conversions API.
     */
    'pixel_id' => env('CONVERSIONS_API_PIXEL_ID'),

    /**
     * The Conversions API comes with a nice way to test your events.
     * You may use this config variable to set your test code.
     */
    'test_code' => null,
];
