<?php

namespace App\Providers;

use App\Models\Alerta;
use App\Models\ConvocatoriaInscripcion;
use App\Models\ConvocatoriaInscripcionHistorial;
use App\Models\DiagnosticoRespuesta;
use App\Models\DiagnosticoResultado;
use App\Models\Lead;
use App\Models\Notificacion;
use App\Policies\AlertPolicy;
use App\Policies\LeadPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\DiagnosticoRespuestaPolicy;
use App\Policies\DiagnosticoResultadoPolicy;
use App\Policies\InscripcionConvocatoriaHistorialPolicy;
use App\Policies\InscripcionConvocatoriaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    protected $policies = [
        //User::class => UserPolicy::class,
        Notificacion::class => NotificationPolicy::class,
        Lead::class => LeadPolicy::class,
        Alerta::class => AlertPolicy::class,
        //GeneralesSection::class => SectionPolicy::class,       
        DiagnosticoResultado::class => DiagnosticoResultadoPolicy::class,
        DiagnosticoRespuesta::class => DiagnosticoRespuestaPolicy::class,
        ConvocatoriaInscripcion::class => InscripcionConvocatoriaPolicy::class,
        ConvocatoriaInscripcionHistorial::class => InscripcionConvocatoriaHistorialPolicy::class
    ];

    public function boot() {
        $this->registerPolicies();
    }
}
