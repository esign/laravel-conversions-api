<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use PHPUnit\Framework\Attributes\Test;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\GoogleTagManagerHead;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Config;

class GoogleTagManagerHeadTest extends TestCase
{
    use InteractsWithViews;

    #[Test]
    public function it_can_render_the_view(): void
    {
        Config::set('conversions-api.gtm_id', 'GTM-123456');
        $component = $this->component(GoogleTagManagerHead::class);

        $component->assertSee("(window,document,'script','dataLayer','GTM-123456')", false);
    }

    #[Test]
    public function it_can_render_the_view_using_custom_data(): void
    {
        Config::set('conversions-api.gtm_id', null);
        $component = $this->component(GoogleTagManagerHead::class, [
            'gtmId' => 'GTM-123456',
        ]);

        $component->assertSee("(window,document,'script','dataLayer','GTM-123456')", false);
    }
}