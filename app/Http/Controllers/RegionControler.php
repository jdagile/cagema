<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Region;
use App\TipoDeAltura;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;

class RegionControler extends Controller
{

  public function all()
  {
      return  Region::all();
  }
    public function show($id)
    {
      $Region = Region::where('id', $id)->first();
      return  $Region;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regiones()
    {
        return View('setting/regiones');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Getregiones()
      {
        $consulta=  DB::table('region')
        ->join('tipodealtura', 'region.id_tipodealtura', '=', 'tipodealtura.id')
        ->select('region.id as id','region.descripcion' ,'tipodealtura.descripcion as tipodealtura' ,'region.estaactivo as estaactivo' )
        ->get();
        $valores = array();
        foreach($consulta as $r){
            $valores[] = $r;
        }
    $regiones= collect($valores);


        return Datatables::of($regiones)->addColumn('action', function ($regiones) {
              $column = '<a href="javascript:void(0)" data-url="' . route('regionesedit', $regiones->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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

        $tiposdealturas= TipoDeAltura::where('estaactivo', true)->get();
              return View('setting/regiones', array( 'tiposdealturas' => $tiposdealturas->toJson() ));

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
           return Region::where('id', $ID)->get()->toJson();
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
         $Regiones = null;
         $Existeregiones = false;
         if($All_input['id']>0)
         {
            $Existeregiones =  Region::where('id' , '=', $All_input['id'])->exists();
         }

                   if($Existeregiones==true  &&  $All_input['id'] != '')
                    {

                      $usersController= new UsersController();
                        $user= $usersController->UsuarioPorEmail(session('email') );
                        $Regiones = Region::where('id', $All_input['id'])->first();
                        $Regiones->id_tipodealtura = $All_input['tipodealtura'];
                        $Regiones->descripcion = $All_input['descripcion'];
                        $Regiones->estaactivo = $estaactivo;
                        $Regiones->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                        $Regiones->save();

                     Session::flash('flash_message', 'Se Edito Exitosamente!');
                      Session::flash('flash_type', 'alert-success');

                     }

                     if($Existeregiones==true && ( $request['id'] == 0   || $request['id'] =='' ))
                      {
                       Session::flash('flash_message', 'Ya existe registrado una parametrización para esta región y estación seleccionada');
                       Session::flash('flash_type', 'alert-warning');

                       }


                                      if($Existeregiones==false)
                                       {
                                         $usersController= new UsersController();
                                         $user= $usersController->UsuarioPorEmail(session('email') );
                                         $Regiones = new Region();
                                         $Regiones->id_tipodealtura = $All_input['tipodealtura'];
                                         $Regiones->descripcion = $All_input['descripcion'];
                                         $Regiones->estaactivo = $estaactivo;
                                         $Regiones->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                         $Regiones->save();
                                         Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                         Session::flash('flash_type', 'alert-success');

                                       }

                                       return redirect()->route('regiones');

       }






}
