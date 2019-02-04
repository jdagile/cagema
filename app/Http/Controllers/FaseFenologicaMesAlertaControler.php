<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaseFenologicaMesAlerta;
use App\Http\Requests;
class FaseFenologicaMesAlertaControler extends Controller
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
    public function ObtenerParametrosDeFaseFenologicaMesAlerta($meses_id,$tipodeproducto_id)
   {
        try {
          $ResultadoFaseFenologicaMesAlerta =null;
         $ResultadoFaseFenologicaMesAlerta = FaseFenologicaMesAlerta::where('meses_id', '=', $meses_id)
              ->where('tipodeproducto_id', '=', $tipodeproducto_id)->get();

            return $ResultadoFaseFenologicaMesAlerta;
            } catch (\Exception $e) {
  }
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
