<?php

namespace App\Services\Giphy;

use Illuminate\Support\ServiceProvider;

class GiphyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('giphy', function ($app) {
            return new Giphy();
        });
    }
}
