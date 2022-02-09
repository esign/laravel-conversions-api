<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;

class ConversionsApiViewTest extends TestCase
{
    /** @test */
    public function it_can_render_the_conversions_api_page_view_directive()
    {
        $this->assertSame(
            '<?php app(\Esign\\ConversionsApi\\ConversionsApi::class)->executePageViewEvent(); ?>',
            Blade::compileString('@conversionsApiPageView'),
        );
    }

    /** @test */
    public function it_can_render_the_data_layer_view()
    {
        $this->assertStringContainsString(
            ConversionsApi::getEventId(),
            view('conversions-api::data-layer')->render()
        );
    }

    /** @test */
    public function it_can_contain_a_default_data_layer_variable_name()
    {
        $this->assertStringContainsString(
            'conversionsApiEventId',
            view('conversions-api::data-layer')->render()
        );
    }

    /** @test */
    public function it_can_use_a_custom_data_layer_variable_name()
    {
        $this->assertStringContainsString(
            'customDataLayerVariableName',
            view('conversions-api::data-layer', ['dataLayerVariableName' => 'customDataLayerVariableName'])->render()
        );
    }

    /** @test */
    public function it_can_render_the_facebook_pixel_script_view()
    {
        Config::set('conversions-api.pixel_id', 'your-pixel-id');

        $this->assertStringContainsString(
            ConversionsApi::getEventId(),
            view('conversions-api::facebook-pixel-script')->render()
        );

        $this->assertStringContainsString(
            'your-pixel-id',
            view('conversions-api::facebook-pixel-script')->render()
        );
    }

    /** @test */
    public function it_can_render_the_facebook_pixel_script_directive()
    {
        $this->assertStringContainsString(
            "<?php echo view('conversions-api::facebook-pixel-script'); ?>",
            Blade::compileString('@conversionsApiFacebookPixelScript'),
        );
    }

    /** @test */
    public function it_can_render_the_data_layer_directive()
    {
        $this->assertStringContainsString(
            "<?php echo view('conversions-api::data-layer', ['dataLayerVariableName' => 'customDataLayerVariableName']); ?>",
            Blade::compileString("@conversionsApiDataLayer('customDataLayerVariableName')"),
        );
    }

    /** @test */
    public function it_can_render_the_data_layer_directive_when_no_arguments_are_provided()
    {
        $this->assertStringContainsString(
            "<?php echo view('conversions-api::data-layer'); ?>",
            Blade::compileString("@conversionsApiDataLayer"),
        );
    }
}
