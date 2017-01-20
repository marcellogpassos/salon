<?php

namespace App\Providers;

use App\Services\ContasExcluidasService;
use App\Services\ContasExcluidasServiceInterface;
use Illuminate\Support\ServiceProvider;

class ContasExcluidasServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {
        $this->app->singleton(ContasExcluidasServiceInterface::class, ContasExcluidasService::class);
    }
}
