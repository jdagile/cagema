<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\User;
Use App\Elementos;
Use App\TipoDeAlerta;
Use App\CorrelacionMaestro;
Use App\CorrelacionDetalle;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class correlacionDetalleControler extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function CorrelacionDetalles()
  {
      return View('setting/correlaciondetalles');
  }/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function GetCorrelacionDetalles()
    {
      $consulta=  DB::table('correlaciondetalle')
      ->join('elementos', 'correlaciondetalle.elementos_id', '=', 'elementos.id')
      ->join('tipodealerta', 'correlaciondetalle.tipodealerta_id', '=', 'tipodealerta.id')
      ->join('correlacionmaestro', 'correlaciondetalle.correlacionmaestro_id', '=', 'correlacionmaestro.id')
      ->orderBy('correlacionmaestro.id' , 'correlaciondetalle.tipodealerta_id', 'correlaciondetalle.elementos_id' ,'ASC')
      ->select('correlaciondetalle.id as id','correlacionmaestro.descripcion as correlacion',   'elementos.descripcion as elemento','tipodealerta.descripcion as tipodealerta' ,  'correlaciondetalle.estaactivo as estaactivo' )
      ->get();
      $valores = array();
      foreach($consulta as $r){

          $valores[] = $r;
      }
  $correlaciondetalle= collect($valores);
      return Datatables::of($correlaciondetalle)->addColumn('action', function ($correlaciondetalle) {
            $column = '<a href="javascript:void(0)" data-url="' . route('correlaciondetallesedit', $correlaciondetalle->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
      $Elementos= Elementos::where('estaactivo', true)->get();
      $TipodeAlertas=TipoDeAlerta::where('estaactivo', true)->get();
      $CorrelacionMaestro=CorrelacionMaestro::where('estaactivo', true)->get();
      return View('setting/correlaciondetalles', array( 'elementos' => $Elementos->toJson(),'tipodealertas' => $TipodeAlertas->toJson(),'correlacionmaestros' => $CorrelacionMaestro->toJson()  ));
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
         return CorrelacionDetalle::where('id', $ID)->get()->toJson();
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
       $correlacionDetalle = null;
       $Existecorrelaciondetalles =  CorrelacionDetalle::where('elementos_id' , '=', $All_input['elementos'])
                                                                                      ->where('tipodealerta_id' , '=', $All_input['tipodealertas'])
                                                                                     ->where('correlacionmaestro_id' , '=', $All_input['correlacionmaestros'])
                                                                                      ->exists();

                 if($Existecorrelaciondetalles==true  &&  $All_input['id'] != '')
                  {

                    $correlacionDetalle = CorrelacionDetalle::where('id', $All_input['id'])->first();
                  $correlacionDetalle->correlacionmaestro_id = $All_input['correlacionmaestros'];
                      $correlacionDetalle->elementos_id = $All_input['elementos'];
                      $correlacionDetalle->tipodealerta_id = $All_input['tipodealertas'];
                      $correlacionDetalle->estaactivo = $estaactivo;
                      $correlacionDetalle->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                      $correlacionDetalle->save();

                   Session::flash('flash_message', 'Se Edito Exitosamente!');
                    Session::flash('flash_type', 'alert-success');

                   }

                   if($Existecorrelaciondetalles==true && ( $request['id'] == 0   || $request['id'] =='' ))
                    {
                     Session::flash('flash_message', 'Ya existe registrado una parametrización para este producto con la fase Fenologica y elemento seleccionado');
                     Session::flash('flash_type', 'alert-warning');

                     }


                                    if($Existecorrelaciondetalles==false)
                                     {

                                       $correlacionDetalle = new CorrelacionDetalle();
                                       $correlacionDetalle->correlacionmaestro_id = $All_input['correlacionmaestros'];
                                       $correlacionDetalle->elementos_id = $All_input['elementos'];
                                       $correlacionDetalle->tipodealerta_id = $All_input['tipodealertas'];
                                       $correlacionDetalle->estaactivo = $estaactivo;
                                        $correlacionDetalle->id_usuariocreo=$usersController->UsuarioPorEmail(session('email') );
                                       $correlacionDetalle->save();
                                       Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                       Session::flash('flash_type', 'alert-success');

                                     }

                                     return redirect()->route('correlaciondetalles');

     }





}
