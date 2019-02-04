<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TipoDeProducto;
class TipoDeProductoControler extends Controller
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
    public function store(Request $request)
    {
        //
    }

    public function ObtenerTipoDeproductosActivosPorMes($meses_id,$tipodeproducto_id)
   {
        try {
          $ResultadoFaseFenologicaMesAlerta =null;
         $ResultadoFaseFenologicaMesAlerta = TipoDeProducto::where('meses_id', '=', $meses_id)
         ->where('tipodeproducto_id', '=', $tipodeproducto_id)->get();
            return $ResultadoFaseFenologicaMesAlerta;
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
        //
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
    public function ObtenerTipoProductosActivos()
   {
        try {
          $ResultadoTipoDeProducto=null;
         $ResultadoTipoDeProducto = TipoDeProducto::where('estaactivo', '=', 1)->get();
            return $ResultadoTipoDeProducto;
            }
            catch (\Exception $e) {
                                    }
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
