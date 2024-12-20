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
            View\Components\Areviews\ReviewsStats::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'areviews-views');

        $this->publishes([
            __DIR__ . '/../config' => config_path('/'),
        ], 'areviews-config');

        $this->publishes([
            __DIR__ . '/../routes/web.php' => base_path('routes/areviews.php'),
        ], 'areviews-routes');

        Paginator::useBootstrap();
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        if (file_exists(base_path('routes/areviews.php'))) {
            $this->loadRoutesFrom(base_path('routes/areviews.php'));
        }else{
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }
    }
}
