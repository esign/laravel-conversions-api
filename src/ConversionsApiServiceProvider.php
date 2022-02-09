<?php

namespace Esign\ConversionsApi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ConversionsApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'conversions-api');
        $this->registerBladeDirectives();

        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('conversions-api.php')], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'conversions-api');
        $this->app->singleton(ConversionsApi::class);
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('conversionsApiDataLayer', function (?string $dataLayerVariableName = null) {
            if (! $dataLayerVariableName) {
                return "<?php echo view('conversions-api::data-layer'); ?>";
            }

            return "<?php echo view('conversions-api::data-layer', ['dataLayerVariableName' => $dataLayerVariableName]); ?>";
        });
        Blade::directive('conversionsApiFacebookPixelScript', function () {
            return "<?php echo view('conversions-api::facebook-pixel-script'); ?>";
        });
        Blade::directive('conversionsApiPageView', function () {
            return "<?php app(\Esign\\ConversionsApi\\ConversionsApi::class)->executePageViewEvent(); ?>";
        });
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/conversions-api.php';
    }

    protected function viewPath(): string
    {
        return __DIR__ . '/../resources/views';
    }
}
