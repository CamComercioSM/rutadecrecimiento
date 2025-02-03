<?php

namespace App\Http\Services;

use App\Models\Banner;
use App\Models\Capsula;
use App\Models\CiiuActividad;
use App\Models\Departamento;
use App\Models\Etapa;
use App\Models\History;
use App\Models\Link;
use App\Models\Municipio;
use App\Models\Notificacion;
use App\Models\PreguntaDimension;
use App\Models\Section;
use App\Models\SectorSecciones;

class CommonService
{
    public static function banners()
    {
        return Banner::all();
    }

    public static function section()
    {
        return Section::find(1);
    }

    public static function footer()
    {
        $section = self::section();
        $json_data = json_decode($section->data);

        return $json_data[1]->attributes;
    }

    public static function data()
    {
        $section = self::section();
        $json_data = json_decode($section->data);

        return $json_data[0]->attributes;
    }

    public static function links()
    {
        return Link::all();
    }

    public static function capsulas()
    {
        
        return Capsula::all();
    }

    public static function departamentos() 
    {    
        return
            Departamento::orderBy('departamentoNOMBRE', 'asc')->
            get(['departamento_id as id', 'departamentoNOMBRE as name']);
    }

    public static function municipios() 
    {    
        return 
            Municipio::orderBy('municipionombreoficial', 'asc')->
            get(['municipio_id as id', 'municipionombreoficial as name', 'departamentoID']);
    }
    
    public static function historias()
    {
        return History::all();
    }

    public static function etapas()
    {
        return Etapa::all();
    }

    public static function dimensiones()
    {
        return PreguntaDimension::all();
    }

    public static function notificaciones() 
    {
        return Notificacion::orderBy('orden', 'asc')->get();
    }
}