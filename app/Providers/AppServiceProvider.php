<?php

namespace App\Providers;

use App\Models\ManpowerRequest;
use App\Policies\ManpowerRequestPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    protected $policies = [
        // Other policies...
        ManpowerRequest::class => ManpowerRequestPolicy::class,
    ];
}
