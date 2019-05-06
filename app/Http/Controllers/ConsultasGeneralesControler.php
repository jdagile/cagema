<?php
use App\Region;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ConsultasGeneralesControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Region = app('App\Http\Controllers\RegionControler')->show(session('region_id'));
      $pronostico =$Region->pronostico;
            return View('consultasgenerales/pronostico'   ,array('pronostico'=>$pronostico));
    }


}
