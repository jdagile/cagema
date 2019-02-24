<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoDeProducto;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class TipoDeProductoControler extends Controller
{
  public function all()
  {
      return  TipoDeProducto::all();
  }
    public function show($id)
    {
      $TipoDeProducto = TipoDeProducto::where('id', $id)->first();
      return  $TipoDeProducto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipodeproducto()
    {
        return View('setting/tipodeproducto');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Gettipodeproducto()
      {
        $consulta=  DB::table('tipodeproducto')
       ->select('tipodeproducto.id as id','tipodeproducto.descripcion' ,'tipodeproducto.estaactivo as estaactivo' )
        ->get();
        $valores = array();
        foreach($consulta as $r){
            $valores[] = $r;
        }
    $tipodeproducto= collect($valores);
        return Datatables::of($tipodeproducto)->addColumn('action', function ($tipodeproducto) {
              $column = '<a href="javascript:void(0)" data-url="' . route('tipodeproductoedit', $tipodeproducto->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
              return View('setting/tipodeproducto');

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
           return TipoDeProducto::where('id', $ID)->get()->toJson();
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
         $TipoDeProductos = null;
         $Existetipodeproducto = false;
         if($All_input['id']>0)
         {
            $Existetipodeproducto =  TipoDeProducto::where('id' , '=', $All_input['id'])->exists();
         }

                   if($Existetipodeproducto==true  &&  $All_input['id'] != '')
                    {
                      $usersController= new UsersController();
                        $user= $usersController->UsuarioPorEmail(session('email') );
                        $TipoDeProductos = TipoDeProducto::where('id', $All_input['id'])->first();
                        $TipoDeProductos->descripcion = $All_input['descripcion'];
                        $TipoDeProductos->estaactivo = $estaactivo;
                        $TipoDeProductos->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                        $TipoDeProductos->save();
                        Session::flash('flash_message', 'Se Edito Exitosamente!');
                        Session::flash('flash_type', 'alert-success');
                     }

                     if($Existetipodeproducto==true && ( $request['id'] == 0   || $request['id'] =='' ))
                      {
                       Session::flash('flash_message', 'Ya existe registrado una parametrización para esta región y estación seleccionada');
                       Session::flash('flash_type', 'alert-warning');

                       }
                                      if($Existetipodeproducto==false)
                                       {
                                         $usersController= new UsersController();
                                         $user= $usersController->UsuarioPorEmail(session('email') );
                                         $TipoDeProductos = new TipoDeProducto();
                                         $TipoDeProductos->descripcion = $All_input['descripcion'];
                                         $TipoDeProductos->estaactivo = $estaactivo;
                                         $TipoDeProductos->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                         $TipoDeProductos->save();
                                         Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                         Session::flash('flash_type', 'alert-success');

                                       }

                                       return redirect()->route('tipodeproducto');

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

}
