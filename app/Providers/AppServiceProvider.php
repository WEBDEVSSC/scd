<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

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

        // Ajuste para el campo de correo en la tabla users
        Schema::defaultStringLength(191);


        // Menu para Administradores
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Menu para OPERARATIVO
        Gate::define('operativo', function ($user) {
            return $user->role === 'operativo';
        });

        // Menu de SUBDIRECTOR
        Gate::define('subdirector', function ($user) {
            return $user->role === 'subdirector';
        });

        // Menu para JEFE DE DEPARTAMENTO
        Gate::define('jefeDepartamento', function ($user) {
            return $user->role === 'jefeDepartamento';
        });

        // Menu para TITULAR DE UNIDAD
        Gate::define('titularUnidad', function ($user) {
            return $user->role === 'titularUnidad';
        });
    }
}
