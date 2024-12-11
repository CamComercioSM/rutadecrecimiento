<?php

namespace App\Http\Services;

use App\Models\Alerta;
use App\Models\Departamento;
use App\Models\Etapa;
use App\Models\Municipio;
use App\Models\Sector;
use App\Models\UnidadProductiva;
use App\Models\UnidadProductivaTamano;
use App\Models\VentasAnuales;
use Carbon\Carbon;

class UnidadProductivaService
{
    private static string $KEY_UNIDAD_PRODUCTIVA_ID = "UNIDAD_PRODUCTIVA__ID";

    static function setUnidadProductiva($id) 
    {
        session([self::$KEY_UNIDAD_PRODUCTIVA_ID => $id]);
    }

    static function getUnidadProductiva() 
    {
        $id = session(self::$KEY_UNIDAD_PRODUCTIVA_ID);
        return UnidadProductiva::find($id);
    }

    static function crearAlerta($tipo, $unidad_id) 
    {
        $alerta = Alerta::where('tipo', $tipo)->where('unidadproductiva_id', $unidad_id)->first();
        
        if ($alerta == null )
        {
            $alerta = New Alerta();
            $alerta->unidadproductiva_id = $unidad_id;
            $alerta->tipo = $tipo;
            $alerta->save();
        }

        return true;
    }

    static function validarDiagnostico($unidad) 
    {    
        $dias = 365;

        if ($unidad->complete_diagnostic == 1)
        {
            $diagnostico = $unidad->diagnosticos()->get()->last();
            if($diagnostico)
            {
                $date_now = Carbon::now();
                $diasDesdeDiagnostic = $date_now->diffInDays($diagnostico->fecha_creacion);
                
                return ($diasDesdeDiagnostic >= $dias) ? "ANUAL" : "NUEVO";
            }
        }

        return "NO";
    }

    static function validarTiempoDiagnostico($unidad, $dias = 365) {

        if ($unidad->complete_diagnostic == 1)
        {
            $diagnostico = $unidad->diagnosticos()->get()->last();
            if($diagnostico)
            {
                $date_now = Carbon::now();
                $diasDesdeDiagnostic = $date_now->diffInDays($diagnostico->fecha_creacion);
                
                return $diasDesdeDiagnostic >= $dias;
            }
        }

        return false;
    }

    static function ajustarValorRespuesta($valor, $opciones) 
    {    
        /*
        * Cuando son variables que tienen solo 3 opciones de respuestas.
        * Se debe ajustar ya que al no cumplir la regla de 5, debe promediarse de manera diferente
        */
        if (count($opciones) == 3)
        {
            if ($valor == 0) return 2;
            else if ($valor == 1) return 3;
            else return 5;
        }

        /*
        * Cuando son variables que tienen solo 4 opciones de respuestas.
        * Se debe ajustar ya que al no cumplir la regla de 5, debe promediarse de manera diferente
        */
        if (count($opciones) == 4) 
        {
            if ($valor == 0) return 1;
            else if ($valor == 1) return 3;
            else if ($valor == 2) return 4;
            else return 5;
        }

        if (count($opciones) == 5)
        {
            return $valor > 0 ? $valor + 1 : 1;
        }
    }

    static function localizacion($departamento, $municipio, $direccion)
    {   
        if($departamento && $municipio && $direccion)
        {
            $municipality = Municipio::find($municipio);
            $deparment = Departamento::find($departamento);
            
            $address = $direccion . ',' . $municipality->municipionombreoficial . ',' . $deparment->departamentoNOMBRE;
            $address = str_replace(' ', '+', $address);
            
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=AIzaSyCPqpt_YwJzrvm0CuQndesni_zZ_8GTDUA';
            $response = json_decode(file_get_contents($url));
            
            if (isset($response->results[0])) {
                $lat = $response->results[0]->geometry->location->lat;
                $lng = $response->results[0]->geometry->location->lng;

                return $lat . ',' . $lng;
            }

            return null;
        }
    }

    static function setTipoUnidad($company, $unidadProductiva)
    {   
        // Si la organizacion es 1, persona natural // Si 2 => establecimiento // Si mayor o igual a 3 => juridica
        if ($unidadProductiva->Persona->organizacion == 1) {
            $company->type_person = 0;
            $company->unidadtipo_id = 1;
        } 
        elseif ($unidadProductiva->organizacion == 2) {
            $company->type_person = 1;
            $company->unidadtipo_id = 2;
        } 
        else {
            $company->type_person = 2;
            $company->unidadtipo_id = 3;
        }
    }

    static function setTamano($unidadProductiva, $ingresostamanoempresarial)
    {   
        if($unidadProductiva->sector != null)
        {
            $ventaAnual = VentasAnuales::where('sectorCODIGO', $unidadProductiva->sector)
                ->where([ 
                    ['ventasAnualesINICIO', '<=', $ingresostamanoempresarial], 
                    ['ventasAnualesFINAL', '>=', $ingresostamanoempresarial] 
                ])->first();

            $unidadProductiva->size = $ventaAnual->ventasAnualesCODIGO;        
            $unidadProductiva->tamano_id = UnidadProductivaTamano::
                    where('tamanoCODIGO', $ventaAnual->ventasAnualesCODIGO)
                    ->first()->tamano_id;
        }
    }
    
    static function setSector($unidadProductiva)
    {   
        $unidadProductiva->sector = null;
        if ($unidadProductiva->comercial_activity <= 3320)
            $unidadProductiva->sector = 0;
        elseif ($unidadProductiva->comercial_activity <= 4390)
            $unidadProductiva->sector = 1;
        elseif ($unidadProductiva->comercial_activity <= 4799)
            $unidadProductiva->sector = 2;
        elseif ($unidadProductiva->comercial_activity <= 9900)
            $unidadProductiva->sector = 1;

        if($unidadProductiva->sector != null)
        {
            $unidadProductiva->sector_id = 
                Sector::where('sectorCODIGO', $unidadProductiva->sector)
                ->first()->sector_id;
        }
    }

    static function setVentasAnuales($unidadProductiva, $ingresostamanoempresarial)
    {   
        $ventaAnual = VentasAnuales::where('sectorCODIGO', $unidadProductiva->sector)
            ->where([ 
                ['ventasAnualesINICIO', '<=', $ingresostamanoempresarial], 
                ['ventasAnualesFINAL', '>=', $ingresostamanoempresarial] 
            ])->first();

        $unidadProductiva->anual_sales = $ventaAnual->ventasAnualesCODIGO;        
        $unidadProductiva->ventaanual_id = $ventaAnual->ventasAnualesID;
    }

    static function getEtapa($value) 
    {
        $etapa = Etapa::
            where([ 
                ['score_inicial', '<=', $value], 
                ['score_final', '>=', $value] 
            ])->first();

        return $etapa->etapa_id;
    }    

    /////////////////////////////////////////////////

    static function getPuntajeDiagnostico($company) 
    {
        //Definimos los dos grupos principales de variables para luego sumar los pesos de cada variable a su respectivo grupo
        $variable_group_0 = 0;
        $variable_group_1 = 0;

        //calculamos el peso de las ventas y lo asignamos al grupo 0
        $variable_group_0 += self::getAnualSalesWeight($company->anual_sales);

        //recorremos las respuestas del ultimo diagnostico
        $ultimoDiagnostico = $company->diagnosticos()->latest()->first();
        $answers = $ultimoDiagnostico->respuestas();

        foreach ($answers as $answer) {
            //Realizamos el calculo para determinar el peso de la respuesta
            $variable = $answer->variable;
            $variable_percentaje = $variable->percentage / 100;
            $answer_percentage = $variable->values[$answer->value]['attributes']['percentage'];
            $answer_weight = $variable_percentaje * $answer_percentage;

            //sumamos el peso de la respuesta al grupo correspondiente
            $variable->variable_group == 0 ? $variable_group_0 += $answer_weight : $variable_group_1 += $answer_weight;
        }

        //obtenemos el calculo final segun los pesos de cada variable
        return ($variable_group_0 * 0.5) + ($variable_group_1 * 0.5);
    }

    static function getAnualSalesWeight($value) 
    {
        $variable_weight = 0.5;
        
        $answers = [
            1 => 30,
            2 => 55,
            3 => 80,
            4 => 110
        ];

        return $answers[$value] * $variable_weight;
    }

    static function disablePoll(): bool {
        $company = self::getUnidadProductiva();
        $company->show_poll = 0;
        $company->save();
        return true;
    }

    ////////////////////////////////////////

    public static function validarRenovacion($last_renovation, $unidad_id) {
        $actual_date = date_create();

        // Capturamos cuando es la proxima fecha de renovacion
        $renovation_date = date_create_from_format('Ymd', date('Y') . '0330');
        if ($actual_date > $renovation_date)
            $renovation_date->add(new \DateInterval('P1Y'));

        $last_renovation = date_create_from_format('Ymd', $last_renovation);
        $next_renovation = $last_renovation->modify('+1 year');

        if($next_renovation <= $renovation_date)
        {
            self::crearAlerta(0, $unidad_id);
        }
    }

    public static function validarSiguienteRenovacion($date_register, $last_renovation, $company_id) {
        $date_register = date_create_from_format('Ymd', $date_register);
        $last_renovation = date_create_from_format('Ymd', $last_renovation);

        $diff = date_diff($date_register, $last_renovation);

        // Si la empresa lleva mas de 2 años registrada, se debe crear una alerta de tipo 2
        if ($diff->y > 2)
            self::crearAlerta(2, $company_id);
    }
}