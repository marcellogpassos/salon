<?php

namespace App\Providers;

use App\Repositories\CategoriasProdutosRepository;
use App\Repositories\CategoriasProdutosRepositoryInterface;
use App\Services\CategoriasProdutosService;
use App\Services\CategoriasProdutosServiceInterface;
use Illuminate\Support\ServiceProvider;

class CategoriasProdutosServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {

        $this->app->singleton(CategoriasProdutosRepositoryInterface::class, CategoriasProdutosRepository::class);
        $this->app->singleton(CategoriasProdutosServiceInterface::class, CategoriasProdutosService::class);
        
    }
}
