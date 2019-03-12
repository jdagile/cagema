<?php
namespace App\Http\Controllers;
use App\Region;
use App\User;
Use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

Class DashBoardController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function DashBoard()
    {
	    $humedad_relativa = app('App\Http\Controllers\EstacionesAlertasControler')->humedad_relativa();
        $temperatura_ambiente = app('App\Http\Controllers\EstacionesAlertasControler')->temperatura_ambiente();
        $UsersCount=User::count();
        $UsersCountLasWeekPercentage=$UsersCount*(User::where('created_at','>=',  date('Y-m-d',strtotime(date('Y-m-d').'-1 month')) )->count())/100;
        $Region = app('App\Http\Controllers\RegionControler')->show(session('region_id'));
        $sectorDeUsuario =$Region->descripcion;
         //cantidad de esaciones por Regiones
       $CantidadDeEstaciones = app('App\Http\Controllers\RegionesEstacionesControler')->CantidadDeEstaciones(session('region_id'));
        //valore acumulados de la region de los ultimos 5 $dias
       $PromediosDeLaRegion = app('App\Http\Controllers\ValoresElementosControler')->PromediosPorSectoryTiempo();

       foreach($PromediosDeLaRegion as $pr){
          if($pr->out_id_elemento==10)
          {
          $ValorPromedioTemperatura = $pr->out_valor;
          }
          if($pr->out_id_elemento==30)
          {
              $ValorPromedioHumedadRelativa = $pr->out_valor;
          }
          if($pr->out_id_elemento==50)
          {
              $ValorPromedioVelocidadDelViento = $pr->out_valor;
          }

       }
    //   alertas del sector o region de usuario  generadas en el dia $mesActual
       $alertaderegion = app('App\Http\Controllers\RegionesAlertasControler')->GetalAlertaDeRegion();

     return view('dashboard',array('UsersCount'=>$UsersCount,'UsersCountLasWeekPercentage'=>$UsersCountLasWeekPercentage,'humedad_relativa'=>$humedad_relativa,
     'temperatura_ambiente'=>$temperatura_ambiente,'sectordeusuario'=>$sectorDeUsuario , 'cantidaddeestaciones' =>$CantidadDeEstaciones ,'valorpromediotemperatura' =>$ValorPromedioTemperatura,'valorpromediohumedadrelativa' => $ValorPromedioHumedadRelativa,
     'valorpromediovelocidaddelviento' => $ValorPromedioVelocidadDelViento ),compact('alertaderegion'));

    }

    public function FileManage()
    {
        return view('filemanage');
    }
}

?>
