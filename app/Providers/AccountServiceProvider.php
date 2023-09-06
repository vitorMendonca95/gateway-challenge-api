<?php

namespace App\Providers;

use App\Interfaces\Account\AccountRepositoryInterface;
use App\Interfaces\Account\AccountServiceInterface;
use App\Repositories\Account\AccountRepository;
use App\Services\Account\AccountService;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AccountServiceInterface::class, AccountService::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
