<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ValoresElementos;
use Carbon\Carbon;
class ValoresElementosControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
