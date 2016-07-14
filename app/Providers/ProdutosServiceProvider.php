<?php

namespace App\Providers;

use App\Repositories\ProdutosRepository;
use App\Repositories\ProdutosRepositoryInterface;
use App\Services\ProdutosService;
use App\Services\ProdutosServiceInterface;
use Illuminate\Support\ServiceProvider;

class ProdutosServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(ProdutosServiceInterface::class, ProdutosService::class);

	}
}
