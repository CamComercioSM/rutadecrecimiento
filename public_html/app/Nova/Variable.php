<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;

class Variable extends Resource {
    use HasDependencies;

    public static $model = \App\Models\DiagnosticoPregunta::class;
    public static $title = 'name';
    public static $search = ['pregunta_id', 'pregunta_titulo'];

    public static function label() {
        return 'Preguntas';
    }

    public function fields(Request $request) {
        return [
            ID::make('pregunta_id'),

            Text::make('Nombre', 'pregunta_titulo')->rules('required'),

            Text::make('Grupo', function () {
                return optional($this->grupo)->preguntagrupo_nombre;
            })->onlyOnIndex()->sortable(),

            Text::make('Dimensión', function () {
                return optional($this->dimension)->preguntadimension_nombre;
            })->onlyOnIndex()->sortable(),

            Text::make('Tipo de variable', function () {
                return optional($this->tipo)->preguntatipo_nombre;
            })->onlyOnIndex()->sortable(),

            NovaDependencyContainer::make([
                Number::make('Nivel de porcentaje', 'pregunta_porcentaje')->rules('required')
                    ->min(0)
                    ->max(100)
                    ->help('Recuerde que la sumataria de los niveles de todas preguntas de la misma dimension debe ser 100%'),

                Flexible::make('Respuestas', 'values')
                    ->button('Agregar opcion')
                    ->addLayout(null, 'product', [
                        Text::make('Respuesta', 'variable_response'),
                        Number::make('Porcentaje', 'percentage'),
                    ]),
            ])->dependsOn('type', 0),

            HasMany::make('Respuestas', 'answers', Answer::class)
        ];
    }

    public function actions(Request $request) {
        return [
            (new Actions\ValidatePercentages())->standalone(),
        ];
    }
}
