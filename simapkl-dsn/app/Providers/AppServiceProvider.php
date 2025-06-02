<?php

namespace App\Providers;

use Filament\FilamentManager;
use Filament\Models\Contracts\HasName;
use Illuminate\Support\ServiceProvider;

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
        $this->app->extend(FilamentManager::class, function ($manager) {
            $manager->macro('getUserName', function ($user) {
                if ($user instanceof HasName) {
                    return $user->getFilamentName();
                }

                return $user->getAttributeValue('username');
            });

            return $manager;
        });
    }
}
