<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;
use App\Models\CiiuActividad;
use App\Models\Municipio;
use App\Models\SectorSecciones;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    
    public function index()
    {
        $data = [
            'section'=> CommonService::section(),
            'banners'=> CommonService::banners(),
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
            'data'=> CommonService::data(),
            'histories'=> CommonService::historias(),
            'Eventos'=> SICAM32::proximosEventos()
        ];
         
        return view('website.home', $data);
    }

    public function mapa()
    {
        $data = [
            'footer'=> CommonService::footer(),
            'links'=> CommonService::links(),
        ];

        return view('website.site_map', $data);
    }


    public function getMunicipios(Request $request) 
    {    
        return 
            Municipio::where('departamentoID', $request->id)->
            orderBy('municipionombreoficial', 'asc')->
            get(['municipio_id as id', 'municipionombreoficial as name']);
    }

    public function getSecciones(Request $request) 
    {    
        return 
            SectorSecciones::where('macroSectorID', $request->id)->
            orderBy('ciiuSeccionTITULO', 'asc')->
            get(['ciiuSeccionID as id', 'ciiuSeccionTITULO as name']);
    }

    public function getActividades(Request $request) 
    {    
        return 
            CiiuActividad::where('ciiuSeccionID', $request->id)->
            orderBy('ciiuActividadTITULO', 'asc')->
            get(['ciiuactividad_id as id', 'ciiuActividadTITULO as name']);
    }
   
}
