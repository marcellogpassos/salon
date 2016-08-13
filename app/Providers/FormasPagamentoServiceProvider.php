<?php

namespace App\Providers;

use App\Services\FormasPagamentoService;
use App\Services\FormasPagamentoServiceInterface;
use Illuminate\Support\ServiceProvider;

class FormasPagamentoServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(FormasPagamentoServiceInterface::class, FormasPagamentoService::class);

	}
}
