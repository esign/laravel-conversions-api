<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelScript;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Config;

class FacebookPixelScriptTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view_using_default_data()
    {
        Config::set('conversions-api.pixel_id', '414800860114807');
        ConversionsApi::setUserData((new UserData())->setEmail('test@test.com'));
        $component = $this->component(FacebookPixelScript::class);

        $component->assertSee("fbq('init', '414800860114807', {\"em\":\"test@test.com\"});", false);
    }

    /** @test */
    public function it_can_render_an_empty_object_for_advanced_matching_data()
    {
        Config::set('conversions-api.pixel_id', '414800860114807');
        $component = $this->component(FacebookPixelScript::class);

        $component->assertSee("fbq('init', '414800860114807', {});", false);
    }

    /** @test */
    public function it_can_render_the_view_passing_custom_data()
    {
        $component = $this->component(FacebookPixelScript::class, [
            'pixelId' => '744689831385767',
            'advancedMatchingData' => ['em' => 'test@test.com'],
        ]);

        $component->assertSee("fbq('init', '744689831385767', {\"em\":\"test@test.com\"});", false);
    }

    /** @test */
    public function it_can_pass_component_attributes()
    {
        $view = $this->blade('
            <x-conversions-api::data-layer-variable
                :arguments="[]"
                class="my-class"
            />
        ');

        $view->assertSee('<script class="my-class">', false);
    }
}
