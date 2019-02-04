<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\UnidadDeMedida;

class UnidadDeMedidaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $unidadDeMedida = UnidadDeMedida::where('simbolo', '=', 'V')->where('simbolo', 'like', '%a%')->get();



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
    public function store($request)
    {
      $seGuardo  =false;
    //  $unidadDeMedida = UnidadDeMedida::where('simbolo', '=', 'V')->where('simbolo', '=', 'V')->get();
    UnidadDeMedida::create($request->all());
        $seGuardo =true;
        return $seGuardo;
     return $unidadDeMedida;
    }


    public function ObtenerTodos()
    {

        return  UnidadDeMedida::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $message =UnidadDeMedida::findOrFail($id);

    }
    public function VerificarExistencia($simbolo)
    {
      $unidadesDeMedida = UnidadDeMedida::where('simbolo', '=', $simbolo)->exists();

       return  $unidadesDeMedida;
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
