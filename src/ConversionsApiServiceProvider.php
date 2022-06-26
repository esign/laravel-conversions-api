<?php

namespace Esign\ConversionsApi;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\View\Components\DataLayerPageView;
use Esign\ConversionsApi\View\Components\DataLayerVariable;
use Esign\ConversionsApi\View\Components\FacebookPixelPageView;
use Esign\ConversionsApi\View\Components\FacebookPixelTrackingEvent;
use Illuminate\Support\ServiceProvider;

class ConversionsApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'conversions-api');
        $this->loadViewComponentsAs('conversions-api', [
            DataLayerPageView::class,
            DataLayerVariable::class,
            FacebookPixelPageView::class,
            FacebookPixelTrackingEvent::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('conversions-api.php')], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'conversions-api');
        $this->app->singleton(ConversionsApi::class);
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
