<?php

namespace Esign\ConversionsApi;

use Esign\ConversionsApi\Facades\ConversionsApi;
use Esign\ConversionsApi\View\Components\DataLayerPageView;
use Esign\ConversionsApi\View\Components\DataLayerUserDataVariable;
use Esign\ConversionsApi\View\Components\DataLayerVariable;
use Esign\ConversionsApi\View\Components\FacebookPixelPageView;
use Esign\ConversionsApi\View\Components\FacebookPixelScript;
use Esign\ConversionsApi\View\Components\FacebookPixelTrackingEvent;
use Esign\ConversionsApi\View\Components\GoogleTagManagerBody;
use Esign\ConversionsApi\View\Components\GoogleTagManagerHead;
use Illuminate\Support\ServiceProvider;

class ConversionsApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'conversions-api');
        $this->loadViewComponentsAs('conversions-api', [
            'data-layer-page-view' => DataLayerPageView::class,
            'data-layer-variable' => DataLayerVariable::class,
            'data-layer-user-variable' => DataLayerUserDataVariable::class,
            'facebook-pixel-script' => FacebookPixelScript::class,
            'facebook-pixel-page-view' => FacebookPixelPageView::class,
            'facebook-pixel-tracking-event' => FacebookPixelTrackingEvent::class,
            'google-tag-manager-body' => GoogleTagManagerBody::class,
            'google-tag-manager-head' => GoogleTagManagerHead::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('conversions-api.php')], 'config');
            $this->publishes([$this->viewPath() => resource_path('views/vendor/conversions-api')], 'views');
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
