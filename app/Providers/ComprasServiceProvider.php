<?php

namespace App\Providers;

use App\Services\ComprasService;
use App\Services\ComprasServiceInterface;
use Illuminate\Support\ServiceProvider;

class ComprasServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {

        $this->app->singleton(ComprasServiceInterface::class, ComprasService::class);

    }
}
