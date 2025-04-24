<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Edicion;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user) {
            // Check if the user is an admin
            if ($user->isAdmin()) {
                return true;
            }
        });
        // Define a gate for the 'store-inscripcion' action
        Gate::define('store-inscripcion', function (?User $user) {
            $edicion = Edicion::getEdicionActual();
            if ($edicion->fecha_apertura <= now() && $edicion->fecha_cierre >= now()) {
                return true;
            }
            return false;
        });
    }
}
