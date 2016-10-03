<?php

namespace App\Providers;

use App\Services\ItensVendaService;
use App\Services\ItensVendaServiceInterface;
use Illuminate\Support\ServiceProvider;

class ItensVendaServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {

        $this->app->singleton(ItensVendaServiceInterface::class, ItensVendaService::class);

    }
}
