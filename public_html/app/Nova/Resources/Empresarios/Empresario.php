<?php

namespace App\Nova\Resources\Empresarios;

use App\Nova\Actions\ExportarEmpresarios;
use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Empresario extends Resource 
{
    public static $model = \App\Models\User::class;
    public static $title = 'name';
    public static $search = ['id', 'identification', 'name', 'lastname', 'email'];

    public static function label() {
        return 'Empresarios';
    }

    public static function singularLabel(){
        return 'Empresario';
    }
    
    public function fields(Request $request) {
        return [
            Number::make('No documento', 'identification')
                ->rules('required'),
                
            Text::make('Nombre (s)', 'name')
                ->rules('required', 'max:255'),

            Text::make('Apellido (s)', 'lastname')
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            HasMany::make('Empresa', 'unidadesProductivas', UnidadProductiva::class),

            Password::make('Contraseña', 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
        ];
    }

    public function actions(Request $request) {
        return [ 
            new ExportarEmpresarios()
        ];
    } 

    public static function indexQuery(NovaRequest $request, $query) {
        return $query->whereDoesntHave('roles');
    }
}
