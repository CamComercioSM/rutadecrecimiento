<?php

namespace App\Nova\Menu;


use App\Nova\Resources\Diagnosticos\Diagnostico;
use App\Nova\Resources\Diagnosticos\DiagnosticoPreguntasBase;
use App\Nova\Resources\Diagnosticos\DiagnosticoResultado;
use App\Nova\Resources\Empresarios\Empresario;
use App\Nova\Resources\Empresarios\UnidadProductiva;
use App\Nova\Resources\Generales\Alerta;
use App\Nova\Resources\Generales\Banner;
use App\Nova\Resources\Generales\Capsula;
use App\Nova\Resources\Generales\Etapa;
use App\Nova\Resources\Generales\Lead;
use App\Nova\Resources\Generales\Notificacion;
use App\Nova\Resources\Generales\PreguntaDimension;
use App\Nova\Resources\Generales\PreguntaGrupo;
use App\Nova\Resources\Generales\PreguntaTipo;
use App\Nova\Resources\Generales\Section;
use App\Nova\Resources\Generales\Setting;
use App\Nova\Resources\Generales\UsuariosAdministradores;
use App\Nova\Resources\Inscripciones\ConvocatoriaInscripcion;
use App\Nova\Resources\Programas\InscripcionesRequisitos;
use App\Nova\Resources\Programas\Programa;
use App\Nova\Resources\Programas\ProgramaIndicador;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Auth;

class Menu {
	public static function init(){

		return new CollapsibleResourceManager([
			'disable_default_resource_manager' => true,
			'remember_menu_state'              => true,
			'navigation'                       => [
                TopLevelResource::make([
                    'icon'      => Icon::World(),
                    'label'     => 'Gestionar',
                    'expanded'  => true,
                    'resources' => [
                        DiagnosticoResultado::class,
                        UnidadProductiva::class,
                        ConvocatoriaInscripcion::class,
                        Notificacion::class,
                        Empresario::class,
                        Lead::class,
                        Alerta::class,
                    ],
                ]),
                TopLevelResource::make([
                    'icon'      => Icon::World(),
                    'label'     => 'Sitio Web',
                    'expanded'  => true,
                    'resources' => [
                        Banner::class,
                        NovaResource::make(Section::class)->detail(1)->label('Pagina principal'),
                    ],
                ]),
                TopLevelResource::make([
                    'icon'      => Icon::Manage(),
                    'label'     => 'Configurar',
                    'expanded'  => true,
                    'resources' => [

                        Diagnostico::class,
                        Programa::class,

                        ProgramaIndicador::class,
                        InscripcionesRequisitos::class,
                        DiagnosticoPreguntasBase::class,

                        Capsula::class,

                        UsuariosAdministradores::class,

                        PreguntaGrupo::class,
                        PreguntaTipo::class,
                        PreguntaDimension::class,                        
                        
                        NovaResource::make(Etapa::class)->canSee(function (){
                            /** @var User $user */
                            $user = Auth::user();

                            return $user->hasAnyRole(['superadmin']);
                        }),
                        
                        NovaResource::make(Setting::class)->canSee(function (){
                            /** @var User $user */
                            $user = Auth::user();

                            return $user->hasAnyRole(['superadmin']);
                        }),
                    ],
                ]),
			]
		]);
	}

}
