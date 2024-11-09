<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Http\Services\SICAM32;

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
   
}
