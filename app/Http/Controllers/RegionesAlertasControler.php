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
      $anio =date("yy",strtotime($fechaActual));

      $consulta=  DB::table('regionesalertas')->join('alertasgenerales', 'regionesalertas.alertasgenerales_id', '=', 'alertasgenerales.id')
     ->where('regionesalertas.dia', 8)
     ->where('regionesalertas.mes', 3)
     ->where('regionesalertas.anio', 2019)
     ->where('regionesalertas.region_id', 2  )
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
