<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ValoresElementos;
use Carbon\Carbon;
use DB;
class ValoresElementosControler extends Controller
{
  public  function PromediosPorSectoryTiempo()
  {

    $promedios_por_regiontiempo =  DB::select('select * from public."listar_promedios_por_regiontiempo_out"('.session('region_id').',5)');
      return $promedios_por_regiontiempo;
  }

    public function store( $valoresElementos)
    {
      try {
        $fechaActual =Carbon::now()->subHours(6)->toDateTimeString();
        $nuevoValorElemento =  new ValoresElementos;
        $nuevoValorElemento->estaciones_id = $valoresElementos["estaciones_id"];
        $nuevoValorElemento->elementos_id =  $valoresElementos["elementos_id"];
        $nuevoValorElemento->unidaddemedida_simbolo = $valoresElementos["unidaddemedida_simbolo"];
        $nuevoValorElemento->fechaestacion =$valoresElementos["fechaestacion"];
        $nuevoValorElemento->valor =$valoresElementos["valor"];
        $nuevoValorElemento->estaactivo = $valoresElementos["estaactivo"];
        $nuevoValorElemento->dia = $valoresElementos["dia"];
        $nuevoValorElemento->mes  = $valoresElementos["mes"];
        $nuevoValorElemento->anio = $valoresElementos["anio"];
        $nuevoValorElemento->created_at  = $fechaActual;
        $nuevoValorElemento->updated_at  = $fechaActual;
        $nuevoValorElemento->save();
        return $nuevoValorElemento->id;
      } catch (\Exception $e) {
        echo "--------ocurrio un error al Registrar ValoresElementos   --->".$e;
      }
    }
    public function VerificarExistencia($valoresElementos)
   {
        try {
          $ResultadoValoresElementos =false;
         $ResultadoValoresElementos = ValoresElementos::where('estaciones_id', '=', $valoresElementos["estaciones_id"])
          ->where('elementos_id', '=', $valoresElementos["elementos_id"])
          ->where('fechaestacion', '=',$valoresElementos["fechaestacion"])->exists();

            return $ResultadoValoresElementos;

            } catch (\Exception $e) {

    }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $unidadDeMedida = ValoresElementos::where('elementos_id', '=', 'V')->where('simbolo', 'like', '%a%')->get();


    }




}
