<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FaseFenologica;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class FaseFenologicaControler extends Controller
{
  public function all()
  {
      return  FaseFenologica::all();
  }
    public function show($id)
    {
      $FaseFenologica = FaseFenologica::where('id', $id)->first();
      return  $FaseFenologica;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fasefenologica()
    {
        return View('setting/fasefenologica');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Getfasefenologica()
      {
        $consulta=  DB::table('fasefenologica')
       ->select('fasefenologica.id as id','fasefenologica.descripcion' ,'fasefenologica.estaactivo as estaactivo','fasefenologica.fechainicio','fasefenologica.fechafin' )
       ->orderBy('fasefenologica.id','ASC')
        ->get();
        $valores = array();
        foreach($consulta as $r){
            $valores[] = $r;
        }
    $fasefenologica= collect($valores);
        return Datatables::of($fasefenologica)->addColumn('action', function ($fasefenologica) {
              $column = '<a href="javascript:void(0)" data-url="' . route('fasefenologicaedit', $fasefenologica->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
              return View('setting/fasefenologica');

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
           return FaseFenologica::where('id', $ID)->get()->toJson();
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
         $FaseFenologicas = null;
         $Existefasefenologica = false;
         if($All_input['id']>0)
         {
            $Existefasefenologica =  FaseFenologica::where('id' , '=', $All_input['id'])->exists();
         }

                   if($Existefasefenologica==true  &&  $All_input['id'] != '')
                    {
                      $usersController= new UsersController();
                        $user= $usersController->UsuarioPorEmail(session('email') );
                        $FaseFenologicas = FaseFenologica::where('id', $All_input['id'])->first();
                        $FaseFenologicas->descripcion = $All_input['descripcion'];
                        $FaseFenologicas->estaactivo = $estaactivo;
                        $FaseFenologicas->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                        $FaseFenologicas->save();
                        Session::flash('flash_message', 'Se Edito Exitosamente!');
                        Session::flash('flash_type', 'alert-success');
                     }

                     if($Existefasefenologica==true && ( $request['id'] == 0   || $request['id'] =='' ))
                      {
                       Session::flash('flash_message', 'Ya existe registrado una parametrización para esta región y estación seleccionada');
                       Session::flash('flash_type', 'alert-warning');

                       }
                                      if($Existefasefenologica==false)
                                       {
                                         $usersController= new UsersController();
                                         $user= $usersController->UsuarioPorEmail(session('email') );
                                         $FaseFenologicas = new FaseFenologica();
                                         $FaseFenologicas->descripcion = $All_input['descripcion'];
                                         $FaseFenologicas->estaactivo = $estaactivo;
                                         $FaseFenologicas->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                         $FaseFenologicas->save();
                                         Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                         Session::flash('flash_type', 'alert-success');

                                       }

                                       return redirect()->route('fasefenologica');

       }




       public function ObtenerFasesFenologicasActivas()
      {
           try {
             $ResultadoFaseFenologica=null;
            $ResultadoFaseFenologica = FaseFenologica::where('estaactivo', '=', 1)->get();
               return $ResultadoFaseFenologica;
               }
               catch (\Exception $e) {
                                       }
     }

}
