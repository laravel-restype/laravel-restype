<?php

namespace LaravelRESType;

use Illuminate\Support\ServiceProvider;

class LaravelRESTypeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/typescript-transformer.php' => config_path('typescript-transformer.php'),
            ],
            'laravel-restype-config'
        );
    }
}
