<?php

namespace App\Providers;

use App\Repositories\UsersRepository;
use App\Repositories\UsersRepositoryInterface;
use App\Services\UsersService;
use App\Services\UsersServiceInterface;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

	public function boot() {

	}

	public function register() {

		$this->app->singleton(UsersServiceInterface::class, UsersService::class);

	}
}
