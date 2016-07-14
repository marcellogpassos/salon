<?php

namespace App\Providers;

use App\Repositories\RolesRepository;
use App\Repositories\RolesRepositoryInterface;
use App\Services\RolesService;
use App\Services\RolesServiceInterface;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider {

	public function boot() {
		//
	}

	public function register() {

		$this->app->singleton(RolesServiceInterface::class, RolesService::class);

	}
}
