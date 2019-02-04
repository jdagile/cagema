<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\User;
Use App\TipoDeProducto;
Use App\FaseFenologica;
Use App\Elementos;
Use App\ValoresAcumuladosPorFaseFenologica;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class ValoresAcumuladosPorFaseFenologicaControler extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function ValoresAcumuladosPorFaseFenologicas()
  {
      return View('setting/valoresacumuladosporfasefenologicas');
  }/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function GetValoresAcumuladosPorFaseFenologicas()
    {
      $consulta=  DB::table('valoresacumuladosporfasefenologicas')
      ->join('tipodeproducto', 'valoresacumuladosporfasefenologicas.tipodeproducto_id', '=', 'tipodeproducto.id')
      ->join('fasefenologica', 'valoresacumuladosporfasefenologicas.fasefenologica_id', '=', 'fasefenologica.id')
      ->join('elementos', 'valoresacumuladosporfasefenologicas.elementos_id', '=', 'elementos.id')
      ->orderBy('valoresacumuladosporfasefenologicas.fasefenologica_id','DESC')
      ->select('valoresacumuladosporfasefenologicas.id as id','tipodeproducto.descripcion as tipodeproducto'  ,'fasefenologica.descripcion as fasefenologica'  ,'elementos.descripcion as elemento' ,'valoresacumuladosporfasefenologicas.valor as valor' ,'valoresacumuladosporfasefenologicas.estaactivo as estaactivo' )
      ->get();
      $valores = array();
      foreach($consulta as $r){

          $valores[] = $r;
      }
  $valoresacumuladosporfasefenologica= collect($valores);


      return Datatables::of($valoresacumuladosporfasefenologica)->addColumn('action', function ($valoresacumuladosporfasefenologica) {
            $column = '<a href="javascript:void(0)" data-url="' . route('valoresacumuladosporfasefenologicasedit', $valoresacumuladosporfasefenologica->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
      $Elementos= Elementos::where('estaactivo', true)->get();
      return View('setting/valoresacumuladosporfasefenologicas', array( 'tipodeproductos' => $TipoDeProductos->toJson() ,'fasefenologicas'=> $FaseFenologicas->toJson(),'elementos' => $Elementos->toJson()  ));

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
         return ValoresAcumuladosPorFaseFenologica::where('id', $ID)->get()->toJson();
     }
       /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
        public function Delete($ID)
        {
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
       $ValoresAcumuladosPorFaseFenologica = null;
       $Existevaloresacumuladosporfasefenologicas =  ValoresAcumuladosPorFaseFenologica::where('tipodeproducto_id' , '=', $All_input['tipodeproductos'])
                                                                                      ->where('fasefenologica_id' , '=' ,$All_input['fasefenologicas'])
                                                                                     ->where('elementos_id' , '=', $All_input['elementos'])
                                                                                       ->exists();




                 if($Existevaloresacumuladosporfasefenologicas==true  &&  $All_input['id'] != '')
                  {

                    $usersController= new UsersController();
                      $user= $usersController->UsuarioPorEmail(session('email') );
                      $ValoresAcumuladosPorFaseFenologica = ValoresAcumuladosPorFaseFenologica::where('id', $All_input['id'])->first();
                      $ValoresAcumuladosPorFaseFenologica->tipodeproducto_id = $All_input['tipodeproductos'];
                      $ValoresAcumuladosPorFaseFenologica->fasefenologica_id = $All_input['fasefenologicas'];
                      $ValoresAcumuladosPorFaseFenologica->elementos_id = $All_input['elementos'];
                      $ValoresAcumuladosPorFaseFenologica->valor = $All_input['valor'];
                      $ValoresAcumuladosPorFaseFenologica->estaactivo = $estaactivo;
                      $ValoresAcumuladosPorFaseFenologica->id_usuariomodifico=$usersController->UsuarioPorEmail(session('email') );
                      $ValoresAcumuladosPorFaseFenologica->save();

                   Session::flash('flash_message', 'Se Edito Exitosamente!');
                    Session::flash('flash_type', 'alert-success');

                   }

                   if($Existevaloresacumuladosporfasefenologicas==true && ( $request['id'] == 0   || $request['id'] =='' ))
                    {
                     Session::flash('flash_message', 'Ya existe registrado una parametrización para este producto con la fase Fenologica y elemento seleccionado');
                     Session::flash('flash_type', 'alert-warning');

                     }


                                    if($Existevaloresacumuladosporfasefenologicas==false)
                                     {

                                       $usersController= new UsersController();
                                       $user= $usersController->UsuarioPorEmail(session('email') );
                                         $ValoresAcumuladosPorFaseFenologica = new ValoresAcumuladosPorFaseFenologica();
                                         $ValoresAcumuladosPorFaseFenologica->tipodeproducto_id = $All_input['tipodeproductos'];
                                         $ValoresAcumuladosPorFaseFenologica->fasefenologica_id = $All_input['fasefenologicas'];
                                         $ValoresAcumuladosPorFaseFenologica->elementos_id = $All_input['elementos'];
                                         $ValoresAcumuladosPorFaseFenologica->valor = $All_input['valor'];
                                         $ValoresAcumuladosPorFaseFenologica->estaactivo = $estaactivo;
                                       $ValoresAcumuladosPorFaseFenologica->id_usuariocreo= $usersController->UsuarioPorEmail(session('email') );
                                       $ValoresAcumuladosPorFaseFenologica->save();
                                       Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                       Session::flash('flash_type', 'alert-success');

                                     }
                                     $TipoDeProductos = TipoDeProducto::where('estaactivo', true)->get();
                                     $FaseFenologicas =  FaseFenologica::where('estaactivo', true)->get();
                                     $Elementos= Elementos::where('estaactivo', true)->get();
                                     return redirect()->route('valoresacumuladosporfasefenologicas');

     }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        protected function ValidateCreateUpdate(Request $request)
        {
       }

       private function verificarExistencia($tipodeproducto_id,$fasefenologica_id,$elementos_id)
       {

       $ValoresAcumuladosPorFaseFenologica = null;
       $Existevaloresacumuladosporfasefenologicas =  ValoresAcumuladosPorFaseFenologica::where('tipodeproducto_id' , '=', $All_input['tipodeproductos'])
                                                                                      ->where('fasefenologica_id' , '=' ,$All_input['fasefenologicas'])
                                                                                     ->where('elementos_id' , '=', $All_input['elementos'])
                                                                                       ->exists();

                    return $Existevaloresacumuladosporfasefenologicas;
       }

}
