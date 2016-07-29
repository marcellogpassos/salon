<?php

namespace App\Providers;

use App\Services\CategoriasServicosService;
use App\Services\CategoriasServicosServiceInterface;
use Illuminate\Support\ServiceProvider;

class CategoriasServicosServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {

        $this->app->singleton(CategoriasServicosServiceInterface::class, CategoriasServicosService::class);

    }

}
