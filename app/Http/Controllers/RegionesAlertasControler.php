<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\RegionesAlertas;
use App\AlertasGenerales;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;

class RegionesAlertasControler extends Controller
{
  public function GetalAlertaDeRegion()
    {
      $fechaActual =  date('Y-m-d');
      $dia =date("d",strtotime($fechaActual));
      $mes =date("m",strtotime($fechaActual));
      $anio =date("Y",strtotime($fechaActual));

      $consulta=  DB::table('regionesalertas')->join('alertasgenerales', 'regionesalertas.alertasgenerales_id', '=', 'alertasgenerales.id')
     ->where('regionesalertas.dia', $dia)
     ->where('regionesalertas.mes', $mes)
     ->where('regionesalertas.anio', $anio)
     ->where('regionesalertas.region_id',  session('region_id'))
     ->where('regionesalertas.estaactivo', true)
     ->select('alertasgenerales.descripcion as alerta'  )
    ->get();
      $valores = array();
      foreach($consulta as $r){
          $valores[] = $r;
      }

      return   $consulta;




    }
}
