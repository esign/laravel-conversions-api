<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\ConversionsApi;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelPageView;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Mockery\MockInterface;

class FacebookPixelPageViewTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        $component = $this->component(FacebookPixelPageView::class);

        $component->assertSee(
            "fbq('track', 'PageView', {}, {\"eventID\":",
            false
        );
    }

    /** @test */
    public function it_can_execute_a_page_view_event()
    {
        $this->mock(ConversionsApi::class, function (MockInterface $mock) {
            $mock->shouldReceive('getUserData')->once();
            $mock->shouldReceive('addEvent')->once()->andReturnSelf();
            $mock->shouldReceive('execute')->once();
        });

        $this->component(FacebookPixelPageView::class);
    }
}
