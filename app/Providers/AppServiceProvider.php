<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // Menu para Administradores
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        // Menu para OPERARATIVO
        Gate::define('isOperativo', function ($user) {
            return $user->role === 'operativo';
        });

        // Menu de SUBDIRECTOR
        Gate::define('isSubdirector', function ($user) {
            return $user->role === 'subdirector';
        });

        // Menu para JEFE DE DEPARTAMENTO
        Gate::define('isJefeDepartamento', function ($user) {
            return $user->role === 'jefeDepartamento';
        });

        // Menu para TITULAR DE UNIDAD
        Gate::define('isTitularUnidad', function ($user) {
            return $user->role === 'titularUnidad';
        });
    }
}
