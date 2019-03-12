<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AlertasGenerales;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class AlertasGeneralesControler extends Controller
{
  public function all()
  {
      return  AlertasGenerales::all();
  }
    public function show($id)
    {
      $AlertasGenerales = AlertasGenerales::where('id', $id)->first();
      return  $AlertasGenerales;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function alertasgenerales()
    {
        return View('setting/alertasgenerales');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Getalertasgenerales()
      {
        $consulta=  DB::table('alertasgenerales')
       ->select('alertasgenerales.id as id','alertasgenerales.descripcion' ,'alertasgenerales.estaactivo as estaactivo' )
       ->orderBy('alertasgenerales.id','ASC')
        ->get();
        $valores = array();
        foreach($consulta as $r){
            $valores[] = $r;
        }
    $alertasgenerales= collect($valores);
        return Datatables::of($alertasgenerales)->addColumn('action', function ($alertasgenerales) {
              $column = '<a href="javascript:void(0)" data-url="' . route('alertasgeneralesedit', $alertasgenerales->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
              return View('setting/alertasgenerales');

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
           return AlertasGenerales::where('id', $ID)->get()->toJson();
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
         $AlertasGeneraless = null;
         $Existealertasgenerales = false;
         if($All_input['id']>0)
         {
            $Existealertasgenerales =  AlertasGenerales::where('id' , '=', $All_input['id'])->exists();
         }

                   if($Existealertasgenerales==true  &&  $All_input['id'] != '')
                    {
                      $usersController= new UsersController();
                        $user= $usersController->UsuarioPorEmail(session('email') );
                        $AlertasGeneraless = AlertasGenerales::where('id', $All_input['id'])->first();
                        $AlertasGeneraless->descripcion = $All_input['descripcion'];
                        $AlertasGeneraless->estaactivo = $estaactivo;
                        $AlertasGeneraless->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                        $AlertasGeneraless->save();
                        Session::flash('flash_message', 'Se Edito Exitosamente!');
                        Session::flash('flash_type', 'alert-success');
                     }

                     if($Existealertasgenerales==true && ( $request['id'] == 0   || $request['id'] =='' ))
                      {
                       Session::flash('flash_message', 'Ya existe registrado una parametrización para esta región y estación seleccionada');
                       Session::flash('flash_type', 'alert-warning');

                       }
                                      if($Existealertasgenerales==false)
                                       {
                                         $usersController= new UsersController();
                                         $user= $usersController->UsuarioPorEmail(session('email') );
                                         $AlertasGeneraless = new AlertasGenerales();
                                         $AlertasGeneraless->descripcion = $All_input['descripcion'];
                                         $AlertasGeneraless->estaactivo = $estaactivo;
                                         $AlertasGeneraless->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                         $AlertasGeneraless->save();
                                         Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                         Session::flash('flash_type', 'alert-success');

                                       }

                                       return redirect()->route('alertasgenerales');

       }


       public function ObtenerAlertasGeneralesActivosPorMes($meses_id,$alertasgenerales_id)
      {
           try {
             $ResultadoFaseFenologicaMesAlerta =null;
            $ResultadoFaseFenologicaMesAlerta = AlertasGenerales::where('meses_id', '=', $meses_id)
            ->where('alertasgenerales_id', '=', $alertasgenerales_id)->get();
               return $ResultadoFaseFenologicaMesAlerta;
               } catch (\Exception $e) {
                }
       }

       public function ObtenerAlertasGeneralesActivos()
      {
           try {
             $ResultadoAlertasGenerales=null;
            $ResultadoAlertasGenerales = AlertasGenerales::where('estaactivo', '=', 1)->get();
               return $ResultadoAlertasGenerales;
               }
               catch (\Exception $e) {
                                       }
     }

}
