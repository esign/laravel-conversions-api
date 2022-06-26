<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\ConversionsApi;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\DataLayerPageView;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Mockery\MockInterface;

class DataLayerPageViewTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view_with_a_default_variable_name()
    {
        $component = $this->component(DataLayerPageView::class);

        $component->assertSee('conversionsApiPageViewEventId', false);
    }

    /** @test */
    public function it_can_render_the_view_with_a_custom_variable_name()
    {
        $component = $this->component(DataLayerPageView::class, [
            'dataLayerVariableName' => 'customVariableName',
        ]);

        $component->assertSee('customVariableName', false);
    }

    /** @test */
    public function it_can_execute_a_page_view_event()
    {
        $this->mock(ConversionsApi::class, function (MockInterface $mock) {
            $mock->shouldReceive('getUserData')->once();
            $mock->shouldReceive('addEvent')->once()->andReturnSelf();
            $mock->shouldReceive('execute')->once();
        });

        $this->component(DataLayerPageView::class);
    }
}
