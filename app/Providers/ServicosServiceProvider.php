<?php

namespace App\Providers;

use App\Services\ServicoService;
use App\Services\ServicoServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicosServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(ServicoServiceInterface::class, ServicoService::class);

	}
}
