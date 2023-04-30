<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ContractRepository\ContractRepositoryInterface;
use App\Repositories\ContractRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ContractRepositoryInterface::class , ContractRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
