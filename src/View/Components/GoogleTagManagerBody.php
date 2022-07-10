<?php

namespace Esign\ConversionsApi\View\Components;

use Illuminate\View\Component;

class GoogleTagManagerBody extends Component
{
    protected ?string $gtmId;

    public function __construct(?string $gtmId = null)
    {
        $this->gtmId = $gtmId ?? config('conversions-api.gtm_id');
    }

    public function render()
    {
        return view('conversions-api::components.google-tag-manager-body', [
            'gtmId' => $this->gtmId,
        ]);
    }
}