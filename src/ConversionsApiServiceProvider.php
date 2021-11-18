<?php

namespace Esign\ConversionsApi;

use Esign\ConversionsApi\Facades\ConversionsApi as ConversionsApiFacade;
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
        Blade::directive('conversionsApiDataLayer', function () {
            return "<?php echo view('conversions-api::data-layer'); ?>";
        });
        Blade::directive('conversionsApiPageView', function () {
            ConversionsApiFacade::executePageViewEvent();
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
