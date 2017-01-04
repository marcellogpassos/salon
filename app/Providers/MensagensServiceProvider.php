<?php

namespace App\Providers;

use App\Services\MensagensService;
use App\Services\MensagensServiceInterface;
use Illuminate\Support\ServiceProvider;

class MensagensServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(MensagensServiceInterface::class, MensagensService::class);

	}
}
