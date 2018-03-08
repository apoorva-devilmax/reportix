<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value, $parameters, $validator) {
            // This will only accept letters, numbers, forward slash, dots, hyphens, underscores and spaces.
            return preg_match('/^[\pL0-9\s-_\/.]+$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\VulnerabilityContract', 'App\Services\VulnerabilityService');
        $this->app->bind('App\Contracts\SeverityContract', 'App\Services\SeverityService');
        $this->app->bind('App\Contracts\ProjectContract', 'App\Services\ProjectService');
        $this->app->bind('App\Contracts\ReportContract', 'App\Services\ReportService');
        $this->app->bind('App\Contracts\IssueContract', 'App\Services\IssueService');
        $this->app->bind('App\Contracts\ScreenshotContract', 'App\Services\ScreenshotService');
    }
}
