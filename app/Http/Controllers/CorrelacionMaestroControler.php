<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\User;
Use App\TipoDeProducto;
Use App\FaseFenologica;
Use App\AlertasGenerales;
Use App\TipoDeAltura;
Use App\CorrelacionMaestro;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class CorrelacionMaestroControler extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function CorrelacionMaestros()
  {
      return View('setting/CorrelacionMaestros');
  }/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function GetCorrelacionMaestros()
    {
      $consulta=  DB::table('correlacionmaestro')
      ->join('tipodeproducto', 'correlacionmaestro.tipodeproducto_id', '=', 'tipodeproducto.id')
      ->join('fasefenologica', 'correlacionmaestro.fasefenologica_id', '=', 'fasefenologica.id')
      ->join('alertasgenerales', 'correlacionmaestro.alertasgenerales_id', '=', 'alertasgenerales.id')
      ->orderBy('tipodeproducto.descripcion','fasefenologica.id','ASC')
      ->select('correlacionmaestro.id as id','tipodeproducto.descripcion as tipodeproducto'  ,'fasefenologica.descripcion as fasefenologica'  ,'alertasgenerales.descripcion as alerta',  'correlacionmaestro.descripcion' , 'correlacionmaestro.estaactivo' )
      ->get();
      $valores = array();
      foreach($consulta as $r){

          $valores[] = $r;
      }
  $correlacionmaestro= collect($valores);
      return Datatables::of($correlacionmaestro)->addColumn('action', function ($correlacionmaestro) {
            $column = '<a href="javascript:void(0)" data-url="' . route('correlacionmaestroedit', $correlacionmaestro->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
      $TipoDeProductos = TipoDeProducto::where('estaactivo', true)->get();
      $FaseFenologicas =  FaseFenologica::where('estaactivo', true)->get();
      $AlertasGenerales = AlertasGenerales::where('estaactivo', true)->get();
      return View('setting/correlacionmaestros', array( 'tipodeproductos' => $TipoDeProductos->toJson() ,'fasefenologicas'=> $FaseFenologicas->toJson(),'alertasgenerales' => $AlertasGenerales->toJson() ));
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
         return CorrelacionMaestro::where('id', $ID)->get()->toJson();
     }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function CreateOrUpdate(Request $request)
     {
         $usersController= new UsersController();
       $estaactivo = $request->get('estaactivo', 0); // second parameter is default value
       $All_input = $request->input();
       $CorrelacionMaestro = null;
       $ExisteCorrelacionMaestros =  CorrelacionMaestro::where('tipodeproducto_id' , '=', $All_input['tipodeproductos'])
                                                                                     ->where('fasefenologica_id' , '=' ,$All_input['fasefenologicas'])
                                                                                     ->where('alertasgenerales_id' , '=', $All_input['alertasgenerales'])
                                                                                     ->exists();
                 if($ExisteCorrelacionMaestros==true  &&  $All_input['id'] != '')
                  {

                      $CorrelacionMaestro = CorrelacionMaestro::where('id', $All_input['id'])->first();
                      $CorrelacionMaestro->tipodeproducto_id = $All_input['tipodeproductos'];
                      $CorrelacionMaestro->fasefenologica_id = $All_input['fasefenologicas'];
                      $CorrelacionMaestro->alertasgenerales_id = $All_input['alertasgenerales'];
                      $CorrelacionMaestro->descripcion = $All_input['descripcion'];
                      $CorrelacionMaestro->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                      $CorrelacionMaestro->estaactivo = $estaactivo;
                      $CorrelacionMaestro->save();

                   Session::flash('flash_message', 'Se Edito Exitosamente!');
                   Session::flash('flash_type', 'alert-success');

                   }

                   if($ExisteCorrelacionMaestros==true && ( $request['id'] == 0   || $request['id'] =='' ))
                    {
                     Session::flash('flash_message', 'Ya existe registrado una parametrización para este producto con la fase Fenologica y elemento seleccionado');
                     Session::flash('flash_type', 'alert-warning');

                     }


                                    if($ExisteCorrelacionMaestros==false)
                                     {
                                         $CorrelacionMaestro = new CorrelacionMaestro();
                                         $CorrelacionMaestro->tipodeproducto_id = $All_input['tipodeproductos'];
                                         $CorrelacionMaestro->fasefenologica_id = $All_input['fasefenologicas'];
                                         $CorrelacionMaestro->alertasgenerales_id = $All_input['alertasgenerales'];
                                         $CorrelacionMaestro->descripcion = $All_input['descripcion'];
                                         $CorrelacionMaestro->estaactivo = $estaactivo;
                                        $CorrelacionMaestro->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                       $CorrelacionMaestro->save();
                                       Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                       Session::flash('flash_type', 'alert-success');

                                     }

                                     return redirect()->route('correlacionmaestros');

     }




}
