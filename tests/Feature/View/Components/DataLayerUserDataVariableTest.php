<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\Objects\DefaultUserData;
use Esign\ConversionsApi\Tests\Support\Events\ContactEvent;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\DataLayerUserDataVariable;
use Esign\ConversionsApi\View\Components\DataLayerVariable;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class DataLayerUserDataVariableTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        ConversionsApi::setUserData(
            DefaultUserData::create()->setEmail('test@test.com')
        );
        $component = $this->component(DataLayerUserDataVariable::class);

        $component->assertSee(
            'window.dataLayer.push({"conversionsApiUserEmail":"test@test.com"});',
            false
        );
    }
}
