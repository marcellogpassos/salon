<?php

namespace App\Providers;

use App\Services\EstatisticasService;
use App\Services\EstatisticasServiceInterface;
use Illuminate\Support\ServiceProvider;

class EstatisticasServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(EstatisticasServiceInterface::class, EstatisticasService::class);

	}
}
