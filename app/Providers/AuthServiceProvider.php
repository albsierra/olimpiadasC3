<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Categoria;
use App\Models\Centro;
use App\Models\Ciclo;
use App\Models\Edicion;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\Participante;
use App\Models\Patrocinador;
use App\Models\Prueba;
use App\Models\Resultado;
use App\Models\User;
use App\Policies\CategoriaPolicy;
use App\Policies\CentroPolicy;
use App\Policies\CicloPolicy;
use App\Policies\EdicionPolicy;
use App\Policies\GradoPolicy;
use App\Policies\GrupoPolicy;
use App\Policies\ParticipantePolicy;
use App\Policies\PatrocinadorPolicy;
use App\Policies\PruebaPolicy;
use App\Policies\ResultadoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use LDAP\Result;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Categoria::class => CategoriaPolicy::class,
        Centro::class => CentroPolicy::class,
        Ciclo::class => CicloPolicy::class,
        Edicion::class => EdicionPolicy::class,
        Grado::class => GradoPolicy::class,
        Grupo::class => GrupoPolicy::class,
        Patrocinador::class => PatrocinadorPolicy::class,
        Prueba::class => PruebaPolicy::class,
        Resultado::class => ResultadoPolicy::class,
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
