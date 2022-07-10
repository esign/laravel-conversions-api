<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use Esign\ConversionsApi\ConversionsApi;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\FacebookPixelPageView;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Str;
use Mockery\MockInterface;

class FacebookPixelPageViewTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_can_render_the_view()
    {
        Str::createUuidsUsing(fn () => 'b13ddf8f-df2d-4554-9ae6-a1a73861b0ad');
        $component = $this->component(FacebookPixelPageView::class);

        $component->assertSee(
            "fbq('track', 'PageView', {}, {\"eventID\":\"b13ddf8f-df2d-4554-9ae6-a1a73861b0ad\"}",
            false
        );
    }

    /** @test */
    public function it_can_execute_a_page_view_event()
    {
        $this->mock(ConversionsApi::class, function (MockInterface $mock) {
            $mock->shouldReceive('getUserData')->once();
            $mock->shouldReceive('clearEvents')->once()->andReturnSelf();
            $mock->shouldReceive('addEvent')->once()->andReturnSelf();
            $mock->shouldReceive('sendEvents')->once();
        });

        $this->component(FacebookPixelPageView::class);
    }
}
