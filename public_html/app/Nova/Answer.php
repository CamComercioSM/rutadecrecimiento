<?php

namespace App\Nova;

use App\Nova\Actions\CreateAnswer;
use App\Nova\Actions\ExportAnwers;
use App\Nova\Filters\ByCompany;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;

class Answer extends Resource {

    public static $model = \App\Models\DiagnosticoRespuesta::class;
    public static $title = 'id';
    public static $search = ['id'];
    public static $perPageViaRelationship = 10;

    public static function label() {
        return 'Respuestas  Diagnosticos';
    }

    public static $searchRelations = [
       'pregunta' => ['pregunta_titulo'],
    ];

    public function fields(Request $request) {
        $fields = [];

        $mains_fields = [
       
            DateTime::make('Fecha', 'fecha_creacion')
            ->hideWhenCreating()->hideWhenUpdating(),

            Text::make('Empresa', function () {
                return optional($this->resultado->unidadproductiva)->business_name;
            })->onlyOnIndex()->sortable(),

            Stack::make('Respuesta', [
                Line::make(null, function (){
                    return $this->pregunta->pregunta_titulo;
                })->asHeading()->onlyOnIndex(),
                Line::make(null, function (){
                    if($this->diagnosticorespuesta_valor == null)
                        return null;

                    /*
                     * Las respuestas estan dadas segun la posicion del array. Sin embargo el nova, define el "key" con el campo "values" del resource de "Variable"
                     * Por tal motivo, debo buscar primero la posicion, luego el key y obtener el value para mostrarlo al usuario
                     */
                    if(!isset($this->pregunta->preguntatipo_id))
                        return null;

                    if($this->pregunta->preguntatipo_id == 0) {
                        $array = array_keys($this->pregunta->pregunta_opcionesJSON);
                         
                        if(!isset($array[$this->diagnosticorespuesta_valor]))
                            return '--';
                            
                        $value = $array[$this->diagnosticorespuesta_valor];
                        return $this->pregunta->pregunta_opcionesJSON[$value]['attributes']['variable_response'];
                    } 
                    elseif($this->pregunta->preguntatipo_id == 1){
                        return number_format($this->value, 0, '.', '.');
                    } 
                    else {
                        return 'file';
                    }
                })
            ])
        ];

        $fields = array_merge($fields, $mains_fields);

        if(isset($this->variable)) {

            $fields[] = Heading::make('<b>'.$this->variable->name.'</b>')
                ->asHtml()->onlyOnForms();

            if($this->variable->type == 0) {
                // Para las variables que son de opci贸n multiple
                $options = [];
                foreach ($this->variable->values as $key => $value) {
                    $options[$key] = $value['attributes']['variable_response'];
                }
                $fields[] = Select::make('Respuesta', 'value')
                    ->options($options)->displayUsingLabels()->onlyOnForms()
                    ->rules('required');
            } else if($this->variable->type == 1) {
                // Para las variables que son de tipo num茅rico
                $fields[] = Number::make('Valor', 'value')
                    ->rules('required')->onlyOnForms();
            } else {
                // Para las variables que son de tipo archivo
            }
        }

        return $fields;
    }

    public function actions(Request $request) {
        return [
            new ExportAnwers(),
            (new CreateAnswer())->standalone(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new ByCompany(),
        ];
    }
}
