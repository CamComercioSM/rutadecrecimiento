<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;
use App\Models\CiiuActividad;
use App\Models\Municipio;
use App\Models\SectorSecciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $sectorId = $request->id;
    
        $secciones = DB::table('ciiu_macrosectores')
            ->join('ciiu_actividades', 'ciiu_macrosectores.sector_id', '=', 'ciiu_actividades.macroSectorID')
            ->join('ciiu_secciones', 'ciiu_actividades.ciiuSeccionID', '=', 'ciiu_secciones.ciiuSeccionID')
            ->where('ciiu_macrosectores.sector_id', $sectorId)
            ->select(
                'ciiu_secciones.ciiuSeccionID as id',
                'ciiu_secciones.ciiuSeccionTITULO as name'
            )
            ->groupBy('ciiu_secciones.ciiuSeccionID', 'ciiu_secciones.ciiuSeccionTITULO')
            ->orderBy('ciiu_secciones.ciiuSeccionTITULO', 'asc')
            ->get();
    
        return response()->json($secciones);
    }
    

    public function getActividades(Request $request) 
    {    
        return 
            CiiuActividad::where('ciiuSeccionID', $request->id)->
            orderBy('ciiuActividadTITULO', 'asc')->
            get(['ciiuactividad_id as id', 'ciiuActividadTITULO as name']);
    }
   
}
