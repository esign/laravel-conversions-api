<?php

namespace Esign\ConversionsApi\Tests\Feature\View\Components;

use PHPUnit\Framework\Attributes\Test;
use Esign\ConversionsApi\ConversionsApi;
use Esign\ConversionsApi\Tests\TestCase;
use Esign\ConversionsApi\View\Components\DataLayerPageView;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Str;
use Mockery\MockInterface;

final class DataLayerPageViewTest extends TestCase
{
    use InteractsWithViews;

    #[Test]
    public function it_can_render_the_view(): void
    {
        Str::createUuidsUsing(fn () => 'b13ddf8f-df2d-4554-9ae6-a1a73861b0ad');
        $component = $this->component(DataLayerPageView::class);

        $component->assertSee(
            'window.dataLayer.push({"event":"conversionsApiPageView","conversionsApiPageViewEventId":"b13ddf8f-df2d-4554-9ae6-a1a73861b0ad"});',
            false
        );
    }

    #[Test]
    public function it_can_execute_a_page_view_event(): void
    {
        $this->mock(ConversionsApi::class, function (MockInterface $mock) {
            $mock->shouldReceive('getUserData')->once();
            $mock->shouldReceive('clearEvents')->once()->andReturnSelf();
            $mock->shouldReceive('addEvent')->once()->andReturnSelf();
            $mock->shouldReceive('sendEvents')->once();
        });

        $this->component(DataLayerPageView::class);
    }
}
