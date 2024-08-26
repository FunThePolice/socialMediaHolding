<?php

namespace App\Providers;

use App\Services\DummyJsonService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DummyJsonService::class, function () {
            return new DummyJsonService(new Client(['base_uri' => 'https://dummyjson.com/']));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
