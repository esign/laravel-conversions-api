<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\GoogleTagManagerBody;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Config;

class GoogleTagManagerBodyTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        Config::set('conversions-api.gtm_id', 'GTM-123456');
        $component = $this->component(GoogleTagManagerBody::class);

        $component->assertSee('https://www.googletagmanager.com/ns.html?id=GTM-123456');
    }

    /** @test */
    public function it_can_render_the_view_using_custom_data()
    {
        Config::set('conversions-api.gtm_id', null);
        $component = $this->component(GoogleTagManagerBody::class, [
            'gtmId' => 'GTM-123456',
        ]);

        $component->assertSee('https://www.googletagmanager.com/ns.html?id=GTM-123456');
    }
}