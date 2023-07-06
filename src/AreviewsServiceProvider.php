<?php

namespace Takshak\Areviews;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AreviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        #$this->commands([InstallCommand::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'areviews');
        $this->loadViewComponentsAs('areviews', [
            View\Components\Areviews\ReviewForm::class,
            View\Components\Areviews\Reviews::class,
            View\Components\Areviews\ReviewCard::class,
            View\Components\Areviews\AdminSidebarLinks::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
            __DIR__ . '/../config' => resource_path('config'),
        ]);

        Paginator::useBootstrap();
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
