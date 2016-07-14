<?php

namespace App\Providers;

use App\Repositories\MarcasProdutosRepository;
use App\Repositories\MarcasProdutosRepositoryInterface;
use App\Services\MarcasProdutosService;
use App\Services\MarcasProdutosServiceInterface;
use Illuminate\Support\ServiceProvider;

class MarcasProdutosServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(MarcasProdutosServiceInterface::class, MarcasProdutosService::class);

	}
}
