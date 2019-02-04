<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
Use App\User;
Use App\TipoDeProducto;
Use App\FaseFenologica;
Use App\Elementos;
Use App\TipoDeAlerta;
Use App\TipoDeAltura;
Use App\ProductoFaseElementoRango;
use Auth;
use Hash;
use Session;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use DB;
class ProductoFaseElementoRangoControler extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function ProductoFaseElementoRangos()
  {
      return View('setting/productofaseelementorangos');
  }/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function GetProductoFaseElementoRangos()
    {
      $consulta=  DB::table('productofaseelementorango')
      ->join('tipodeproducto', 'productofaseelementorango.tipoproducto_id', '=', 'tipodeproducto.id')
      ->join('fasefenologica', 'productofaseelementorango.fasefenologica_id', '=', 'fasefenologica.id')
      ->join('elementos', 'productofaseelementorango.elementos_id', '=', 'elementos.id')
      ->join('tipodealerta', 'productofaseelementorango.tipodealerta_id', '=', 'tipodealerta.id')
      ->join('tipodealtura', 'productofaseelementorango.tipodealtura_id', '=', 'tipodealtura.id')
      ->orderBy('productofaseelementorango.fasefenologica_id','DESC')
      ->select('productofaseelementorango.id as id','tipodeproducto.descripcion as tipodeproducto'  ,'fasefenologica.descripcion as fasefenologica'  ,'elementos.descripcion as elemento','tipodealerta.descripcion as tipodealerta' , 'tipodealtura.descripcion as tipodealtura', 'productofaseelementorango.valorminimo' , 'productofaseelementorango.valormaximo' , 'productofaseelementorango.estaactivo as estaactivo' )
      ->get();
      $valores = array();
      foreach($consulta as $r){

          $valores[] = $r;
      }
  $productofaseelementorango= collect($valores);
      return Datatables::of($productofaseelementorango)->addColumn('action', function ($productofaseelementorango) {
            $column = '<a href="javascript:void(0)" data-url="' . route('productofaseelementorangosedit', $productofaseelementorango->id) . '"  class="edit btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
      $TipodeAlertas=TipoDeAlerta::where('estaactivo', true)->get();
      $TipodeAlturas=TipoDeAltura::where('estaactivo', true)->get();
      return View('setting/productofaseelementorangos', array( 'tipodeproductos' => $TipoDeProductos->toJson() ,'fasefenologicas'=> $FaseFenologicas->toJson(),'elementos' => $Elementos->toJson(),'tipodealertas' => $TipodeAlertas->toJson(),'tipodealturas'  =>$TipodeAlturas  ));
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
         return ProductoFaseElementoRango::where('id', $ID)->get()->toJson();
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
       $ProductoFaseElementoRango = null;
       $Existeproductofaseelementorangos =  ProductoFaseElementoRango::where('tipoproducto_id' , '=', $All_input['tipodeproductos'])
                                                                                      ->where('fasefenologica_id' , '=' ,$All_input['fasefenologicas'])
                                                                                     ->where('elementos_id' , '=', $All_input['elementos'])
                                                                                     ->where('tipodealerta_id' , '=', $All_input['tipodealertas'])
                                                                                     ->where('tipodealtura_id' , '=', $All_input['tipodealturas'])
                                                                                      ->exists();




                 if($Existeproductofaseelementorangos==true  &&  $All_input['id'] != '')
                  {

                    $usersController= new UsersController();

                      $ProductoFaseElementoRango = ProductoFaseElementoRango::where('id', $All_input['id'])->first();
                      $ProductoFaseElementoRango->tipoproducto_id = $All_input['tipodeproductos'];
                      $ProductoFaseElementoRango->fasefenologica_id = $All_input['fasefenologicas'];
                      $ProductoFaseElementoRango->elementos_id = $All_input['elementos'];
                      $ProductoFaseElementoRango->tipodealerta_id = $All_input['tipodealertas'];
                      $ProductoFaseElementoRango->tipodealtura_id = $All_input['tipodealturas'];
                      $ProductoFaseElementoRango->valorminimo = $All_input['valorminimo'];
                      $ProductoFaseElementoRango->valormaximo = $All_input['valormaximo'];
                      $ProductoFaseElementoRango->estaactivo = $estaactivo;
                      $ProductoFaseElementoRango->save();

                   Session::flash('flash_message', 'Se Edito Exitosamente!');
                    Session::flash('flash_type', 'alert-success');

                   }

                   if($Existeproductofaseelementorangos==true && ( $request['id'] == 0   || $request['id'] =='' ))
                    {
                     Session::flash('flash_message', 'Ya existe registrado una parametrización para este producto con la fase Fenologica y elemento seleccionado');
                     Session::flash('flash_type', 'alert-warning');

                     }


                                    if($Existeproductofaseelementorangos==false)
                                     {


                                         $ProductoFaseElementoRango = new ProductoFaseElementoRango();
                                         $ProductoFaseElementoRango->tipoproducto_id = $All_input['tipodeproductos'];
                                         $ProductoFaseElementoRango->fasefenologica_id = $All_input['fasefenologicas'];
                                         $ProductoFaseElementoRango->elementos_id = $All_input['elementos'];
                                         $ProductoFaseElementoRango->tipodealerta_id = $All_input['tipodealertas'];
                                         $ProductoFaseElementoRango->tipodealtura_id = $All_input['tipodealturas'];
                                         $ProductoFaseElementoRango->valorminimo = $All_input['valorminimo'];
                                         $ProductoFaseElementoRango->valormaximo = $All_input['valormaximo'];
                                         $ProductoFaseElementoRango->estaactivo = $estaactivo;
                                       $ProductoFaseElementoRango->save();
                                       Session::flash('flash_message', 'Se Guardo Exitosamente!');
                                       Session::flash('flash_type', 'alert-success');

                                     }

                                     return redirect()->route('productofaseelementorangos');

     }


       public function ObtenerParametrosDeProductoFaseElementoRango($valores)
          {
              try {
                $ResultadoProductoFaseElementoRango =null;
               $ResultadoProductoFaseElementoRango = ProductoFaseElementoRango::where('tipoproducto_id', '=', $valores["tipoproducto_id"])
                ->where('fasefenologica_id', '=',$valores["fasefenologica_id"])->get();

                  return $ResultadoProductoFaseElementoRango;

                  } catch (\Exception $e) {
                    }
          }


}
