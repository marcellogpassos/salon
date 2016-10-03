<?php

namespace App\Providers;

use App\Services\BandeirasCartoesService;
use App\Services\BandeirasCartoesServiceInterface;
use Illuminate\Support\ServiceProvider;

class BandeirasCartoesServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {

        $this->app->singleton(BandeirasCartoesServiceInterface::class, BandeirasCartoesService::class);

    }
}
