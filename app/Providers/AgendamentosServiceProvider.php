<?php

namespace App\Providers;

use App\Services\AgendamentosService;
use App\Services\AgendamentosServiceInterface;
use Illuminate\Support\ServiceProvider;

class AgendamentosServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(AgendamentosServiceInterface::class, AgendamentosService::class);

	}
}
