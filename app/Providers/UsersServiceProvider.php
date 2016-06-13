<?php

namespace App\Providers;

use App\Repositories\UsersRepository;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {
    
    public function boot() {

    }

    public function register() {

        $this->app->singleton(UsersRepositoryInterface::class, UsersRepository::class);

    }
}
