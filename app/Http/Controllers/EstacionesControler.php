<?php

namespace App\Http\Controllers;
use App\Estaciones;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class EstacionesControler extends Controller
{

    public function ObtenerTodos()
    {

        return  Estaciones::all();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function VerificarExistencia($id)
     {
       $exixteLaEstacion = Estaciones::where('id', '=', $id)->exists();

        return  $exixteLaEstacion;
         echo $id."----------------se  verifico--------------------".'<br>';
     }

     public function show($id)
     {

       $estaciones = Estaciones::where('id', '=', $id)->first();

        return  $estaciones;
     }
     public function store( $estacion)
     {

     $id  =   $estacion["id"] ;

       $exixteLaEstacion =  Estaciones::where('id', '=', $id)->exists();
        $fechaActual =Carbon::now()->subHours(6)->toDateTimeString();
        $estaciones=null;
        $estaciones = new Estaciones();

       try {
         //Se verifica si el perfil es 6 o 7 porque estas estaciones envian informacion acumulada cada hora otros
         //perfiles de estacion envian exactamente el valor de precipitacion de la hora
         $acumulaprecipitacion = false;
         if($estacion["perfil_id"] ==6 )
         {
           $acumulaprecipitacion = true;
         }
           elseif ($estacion["perfil_id"] ==7) {
           $acumulaprecipitacion = true;
           }
           else {
             $acumulaprecipitacion = false;
           }

         if($exixteLaEstacion == false)
         {

           $estaciones->descripcion =  $estacion["descripcion"];
           $estaciones->latitud = $estacion["latitud"];
           $estaciones->longitud =$estacion["longitud"];
           $estaciones->elevacion =$estacion["elevacion"];
           $estaciones->departamentos_id = $estacion["departamentos_id"];
           $estaciones->municipios_id = $estacion["municipios_id"];
           $estaciones->cuencas_id  = $estacion["cuencas_id"];
           $estaciones->perfil_id = $estacion["perfil_id"];
           $estaciones->estaactivo = true;
           $estaciones->id_usuariocreo = $estacion["id_usuariocreo"];
           $estaciones->created_at = $estacion["created_at"];
           $estaciones->acumulaprecipitacion =$acumulaprecipitacion;
           echo "----------------Nueva estacion Creada en CICOHALERT--------------------".'<br>';
         }
         if($exixteLaEstacion == true)
         {
              $estaciones->id =  $id;
              $estaciones= Estaciones::where('id', '=', $id)->first();
              $estaciones->descripcion =  $estacion["descripcion"];
              $estaciones->latitud = $estacion["latitud"];
              $estaciones->longitud =$estacion["longitud"];
              $estaciones->elevacion =$estacion["elevacion"];
              $estaciones->departamentos_id = $estacion["departamentos_id"];
              $estaciones->municipios_id = $estacion["municipios_id"];
              $estaciones->cuencas_id  = $estacion["cuencas_id"];
              $estaciones->perfil_id = $estacion["perfil_id"];
              $estaciones->id_usuariomodifico = $estacion["id_usuariomodifico"];
              $estaciones->updated_at = $estacion["updated_at"];
              $estaciones->acumulaprecipitacion =$acumulaprecipitacion;
            echo "----------------Actualizacion de estacion--------------------".'<br>';
         }
         $estaciones->save();

        return $estaciones->id  ;
       } catch (\Exception $e) {
         echo "--------ocurrio un error al Registrar Estaciones   --->".$e;
       }
     }

}
