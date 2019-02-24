<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Region;
use App\RegionesEstaciones;
use App\Estaciones;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class RegionesEstacionesControler extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function regionesestaciones()
  {
      return View('setting/regionesestaciones');
  }/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function Getregionesestaciones()
    {
      $consulta=  DB::table('regionesestaciones')
      ->join('region', 'regionesestaciones.region_id', '=', 'region.id')
      ->join('estaciones', 'regionesestaciones.estaciones_id', '=', 'estaciones.id')
      ->orderBy('regionesestaciones.estaciones_id','DESC')
      ->select('regionesestaciones.id as id','region.descripcion as region'  ,'estaciones.descripcion as estacion'  ,'regionesestaciones.estaactivo as estaactivo' )
      ->get();
      $valores = array();
      foreach($consulta as $r){
          $valores[] = $r;
      }
  $regionesestaciones= collect($valores);


      return Datatables::of($regionesestaciones)->addColumn('action', function ($regionesestaciones) {
            $column = '<a href="javascript:void(0)" data-url="' . route('regionesestacionesedit', $regionesestaciones->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
             return $column;
              })->make(true);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $regiones = Region::where('estaactivo', true)->get();
      $Estaciones =  Estaciones::where('estaactivo', true)->get();
      return View('setting/regionesestaciones', array( 'regiones' => $regiones->toJson() ,'estaciones'=> $Estaciones->toJson()));

    }
    public function CantidadDeEstaciones($region_id)
     {
       $cantidad =  RegionesEstaciones::where('region_id', $region_id)->count();
       return  $cantidad ;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MangePermissions()
    {
        return View('users/managepermissions');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function Edit($ID)
     {
         return RegionesEstaciones::where('id', $ID)->get()->toJson();
     }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function CreateOrUpdate(Request $request)
     {
          $estaactivo = $request->get('estaactivo', 0); // second parameter is default value
       $All_input = $request->input();
       $RegionesEstaciones = null;
       $Existeregionesestaciones =  RegionesEstaciones::where('region_id' , '=', $All_input['regiones'])
                                                                                      ->where('estaciones_id' , '=' ,$All_input['estaciones'])
                                                                                       ->exists();




                 if($Existeregionesestaciones==true  &&  $All_input['id'] != '')
                  {

                    $usersController= new UsersController();
                      $user= $usersController->UsuarioPorEmail(session('email') );
                      $RegionesEstaciones = RegionesEstaciones::where('id', $All_input['id'])->first();
                      $RegionesEstaciones->region_id = $All_input['regiones'];
                      $RegionesEstaciones->estaciones_id = $All_input['estaciones'];
                      $RegionesEstaciones->estaactivo = $estaactivo;
                      $RegionesEstaciones->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                      $RegionesEstaciones->save();

                   Session::flash('flash_message', 'Se Edito Exitosamente!');
                    Session::flash('flash_type', 'alert-success');

                   }

                   if($Existeregionesestaciones==true && ( $request['id'] == 0   || $request['id'] =='' ))
                    {
                     Session::flash('flash_message', 'Ya existe registrado una parametrización para esta región y estación seleccionada');
                     Session::flash('flash_type', 'alert-warning');

                     }


                                    if($Existeregionesestaciones==false)
                                     {

                                       $usersController= new UsersController();
                                       $user= $usersController->UsuarioPorEmail(session('email') );
                                         $RegionesEstaciones = new RegionesEstaciones();
                                         $RegionesEstaciones->region_id = $All_input['regiones'];
                                         $RegionesEstaciones->estaciones_id = $All_input['estaciones'];
                                         $RegionesEstaciones->estaactivo = $estaactivo;
                                       $RegionesEstaciones->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                       $RegionesEstaciones->save();
                                       Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                       Session::flash('flash_type', 'alert-success');

                                     }

                                     return redirect()->route('regionesestaciones');

     }


       private function verificarExistencia($region_id,$estaciones_id)
       {

       $RegionesEstaciones = null;
       $Existeregionesestaciones =  RegionesEstaciones::where('region_id' , '=', $All_input['regiones'])
                                            ->where('estaciones_id' , '=' ,$All_input['estaciones'])
                                             ->exists();

                    return $Existeregionesestaciones;
       }

}
