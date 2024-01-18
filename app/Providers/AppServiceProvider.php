<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Splade::share('fusion', [
            'approval_request_sent' => session()->get('approval_request_sent', false),
        ]);

        if (Schema::hasTable('companies')) {
            Splade::share('companies', Company::query()->get());
        }
    }
}
