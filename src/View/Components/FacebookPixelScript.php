<?php

namespace Esign\ConversionsApi\View\Components;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Illuminate\View\Component;

class FacebookPixelScript extends Component
{
    protected ?string $pixelId;
    protected array $advancedMatchingData;
    /**
     * Manage GDPR consent by revoking consent before pixel init
     * @see https://developers.facebook.com/docs/meta-pixel/implementation/gdpr/#cookieconsent
     */
    protected ?bool $revoke;

    /**
     * @param null|string $pixelId
     * @param null|array $advancedMatchingData https://developers.facebook.com/docs/meta-pixel/advanced/advanced-matching#reference
     * @return void
     */
    public function __construct(
        ?string $pixelId = null,
        ?array $advancedMatchingData = null,
        ?bool $revoke = false,
    ) {
        $this->pixelId = $pixelId ?? config('conversions-api.pixel_id');
        $this->advancedMatchingData = $advancedMatchingData ?? $this->getAdvancedMatchingDataFromConversionsApiUserData();
        $this->revoke = $revoke;
    }

    protected function getAdvancedMatchingDataFromConversionsApiUserData(): array
    {
        $userData = ConversionsApi::getUserData();

        return array_filter([
            'em' => $userData->getEmail(),
            'fn' => $userData->getFirstName(),
            'ln' => $userData->getLastName(),
            'ph' => $userData->getPhone(),
            'external_id' => $userData->getExternalId(),
            'ge' => $userData->getGender(),
            'db' => $userData->getDateOfBirth(),
            'ct' => $userData->getCity(),
            'st' => $userData->getState(),
            'zp' => $userData->getZipCode(),
            'country' => $userData->getCountryCode(),
        ]);
    }

    public function render()
    {
        return view('conversions-api::components.facebook-pixel-script', [
            'pixelId' => $this->pixelId,
            'advancedMatchingData' => $this->advancedMatchingData,
            'revoke' => $this->revoke,
        ]);
    }
}
