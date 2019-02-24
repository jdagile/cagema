<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\EstacionesAlertas ;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use DB;

class EstacionesAlertasControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usersController= new UsersController();
        $user= $usersController->UsuarioPorEmail(session('email') );

$estacionesalertas=  DB::table('valoreselementos')
              ->join('estaciones', 'valoreselementos.estaciones_id', '=', 'estaciones.id')
              ->join('elementos', 'valoreselementos.elementos_id', '=', 'elementos.id')
              ->join('unidaddemedida', 'valoreselementos.unidaddemedida_simbolo', '=', 'unidaddemedida.simbolo')
              ->join('estacionesalertas', 'estacionesalertas.valoreselementos_id', '=', 'valoreselementos.id')
              ->join('tipodealerta', 'estacionesalertas.tipodealerta_id', '=', 'tipodealerta.id')
              ->join('regionesestaciones', 'regionesestaciones.estaciones_id', '=', 'estaciones.id')
              ->where('regionesestaciones.region_id' , '=', $user->regions_id)
              ->orderBy('estaciones.descripcion','DESC')
              ->select('niveldealerta.descripcion as nivel', 'tipodealerta.descripcion as aviso', 'niveldealerta.id as idNivel' ,'estaciones.descripcion as estacion','elementos.descripcion as elemento','valoreselementos.valor' ,'unidaddemedida.descripcion as unidadDeMedida' ,'valoreselementos.fechaestacion'   )
              ->get();

  return View('estacionesalertas')->with('estacionesalertas',$estacionesalertas);

//return json_encode($estacionesalertas);
    }


public function alertacalendario()
{

  $estacionesalertas = DB::select('select * from public."listar_alertas_out"()');
  //$listaDeAlertas::query()->make(true);
  $resultado = array();
  foreach($estacionesalertas as $r){
      $resultado[] = $r;
  }
  print_r(json_encode($estacionesalertas));
    return View('estacionesalertas')->with('estacionesalertas',json_encode($estacionesalertas));

}


public function temperatura_ambiente()
{
    return $this->recuperar_elemento_por_dias(10, 5);
}

public function humedad_relativa()
{
    return $this->recuperar_elemento_por_dias(30, 5);
}

public function recuperar_elemento_por_dias($elemento, $dias) {
	return DB::select('select * from public."listar_elemento_por_dias"('. session('region_id')  .','  .$elemento.','.$dias.')');
}

public function listar_promedios_por_region_out($sector_id)
{

  $promedios_por_region = DB::select('select * from public."listar_promedios_por_region_out"( ' .$sector_id.' )');
  //$listaDeAlertas::query()->make(true);
  $resultado = array();
  foreach($promedios_por_region as $r){
      $resultado[] = $r;
  }
  //print_r(json_encode($promedios_por_region));
    return View('DashBoard')->with('promedios_por_region',json_encode($promedios_por_region));

}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store( $valores)
     {
       try {
         $fechaActual =Carbon::now()->subHours(6)->toDateTimeString();
         $nuevoEstacionesAlertas =  new EstacionesAlertas;
         $nuevoEstacionesAlertas->valoreselementos_id = $valores["valoreselementos_id"];
         $nuevoEstacionesAlertas->tipodealerta_id =  $valores["tipodealerta_id"];
         $nuevoEstacionesAlertas->created_at  = $fechaActual;
         $nuevoEstacionesAlertas->updated_at  = $fechaActual;
         $nuevoEstacionesAlertas->save();
         return $nuevoEstacionesAlertas->id;
       } catch (\Exception $e) {
         echo "--------ocurrio un error al Registrar nuevoEstacionesAlertas   --->".$e;
       }
     }



    public function anyData()
    {
      return DataTables::eloquent(EstacionesAlertas::query())->make(true);

    }

    public function listaDeAlertas()
    {
    $listaDeAlertas = DB::select('call listar_alertas_out()');
    return View('lista')->with('lista',$listaDeAlertas);
    }



}
