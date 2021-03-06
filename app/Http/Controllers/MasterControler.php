<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Elementos;
use App\UnidadDeMedida;
use App\Estaciones;
use App\ValoresElementos;
use Carbon\Carbon;
use DB;
class MasterControler extends Controller
{
/*
                                       PUNTOS IMPORANTES POR PROGRAMAR
1.Definir en que fase fenologica del año estamos *OK*
2.Sincronizar automaticamente tablas generales *OK*
3.Determinar si  una jornada Diurna o Nocturna en base a la hora del dia *OK*
4.Registro de Valores elementos.*OK*
5.Registro de Alertas.ok
6.La validacion de precipitacion del cuadro de excel de capucas debe realizar en base a acumulados
7. definir seting para creacion de variables locales.
8.Investigar e implementar elRolback en eloquent laravel
*/
  public function index()
  {
    //unidadesDeMedidas
    $unidadesControler =null;
    $unidadDeMedidaControler       = new UnidadDeMedidaControler();
    $unidadesDeMedidas   =  $unidadDeMedidaControler->ObtenerTodos();
//Elementos.
$elementosControlador= null;
$elementosControlador = new ElementosControler();
$elementos =$elementosControlador->ObtenerTodos();



    //llamar el metodo DatosDeUltimaHora es el que cosumenel API en el controlador ConsumirApiDeCICOHControler
     $datosDeUltimaHora =null;
     $controlador =null;
     $controlador = new ConsumirApiDeCICOHControler();
     $items = $controlador->DatosDeUltimaHora();
     $datosDeEstaciones = $controlador->DatosDeEstaciones();
     echo "----------------Estaciones--------------------".'<br>';
     foreach($datosDeEstaciones ['resource']  as $datosdeestacion ) {
         $fechaActual =Carbon::now()->subHours(6)->toDateTimeString();

                     $estacion = new Estaciones();

                      $estacion->id=$datosdeestacion['id'];
                      $estacion->descripcion = $datosdeestacion['name'];
                      $estacion->latitud =$datosdeestacion['latitude'];
                      $estacion->longitud =$datosdeestacion['longitude'];
                      $estacion->elevacion =$datosdeestacion['elevation'];
                      $estacion->departamentos_id =$datosdeestacion['region_id'];
                      $estacion->municipios_id =$datosdeestacion['municipality_id'];
                      $estacion->cuencas_id =$datosdeestacion['basin_id'];
                      $estacion->perfil_id =$datosdeestacion['profile_id'];
                      $estacion->id_usuariocreo = 1;
                      $estacion->created_at  = $fechaActual;
                      $estacion->updated_at  = $fechaActual;
                      $estacion->id_usuariomodifico = 1;
                      $estacionesControler =null;
                      $estacionesControler = new EstacionesControler();
                      $estacionesControler->store( $estacion );
                     $estacion =null;
                  


}



     //Tipo de Produtos.
     $tipoDeProductoControler =null;
     $tipoDeProductoControler = new TipoDeProductoControler();
     $tipoDeProducto =$tipoDeProductoControler->ObtenerTipoProductosActivos();
     echo "----------------TipoDeProducto--------------------".'<br>';
     $valoreselementos_id=0;
     foreach ($tipoDeProducto as $tipoProducto) {
             $valor=  $tipoProducto['id'];
             echo ' ---------       '.$valor.'<br>';
       //Fase fenologica.
        $fechaActual =Carbon::now();
       $mesActual =date("m",strtotime($fechaActual));
       $faseFenologicaMesAlertaControler= new FaseFenologicaMesAlertaControler();
       $faseFenologicaMesAlerta =$faseFenologicaMesAlertaControler->ObtenerParametrosDeFaseFenologicaMesAlerta($mesActual,$tipoProducto['id']);
       foreach ($faseFenologicaMesAlerta as $fase) {
       $valor=  $fase['fasefenologica_id'];
       echo ' ---------Fases Fenologica       '.$valor.'<br>';

              foreach($items ['resource']  as $item ) {
                             //tiempo de estacionenes.
                             $fechaDeEstacion=   $item['datetime'];
                              $hora =date("H",strtotime($fechaDeEstacion));
                             $dia =date("d",strtotime($fechaDeEstacion));
                             $mes =date("m",strtotime($fechaDeEstacion));
                             $anio =date("y",strtotime($fechaDeEstacion));


                             //Verificar el registro de unidades de UnidadDeMedida
                                $existeUnidadDeMedida = $unidadDeMedidaControler->VerificarExistencia($item['symbol'] );
                                        if(!$existeUnidadDeMedida)
                                        {
                                     $nuevaUnidadDeMedida = new UnidadDeMedida();
                                     $nuevaUnidadDeMedida->simbolo = $item['symbol'];
                                     $nuevaUnidadDeMedida->descripcion = $item['symbol'];
                                     $nuevaUnidadDeMedida->estaactivo = true;
                                     $nuevaUnidadDeMedida->id_usuariocreo = 1;
                                     $nuevaUnidadDeMedida->save();
                                     $existeUnidadDeMedida =true;
                                      echo "----------------Se Creo una nueva Unidad de medida--------------------".'<br>';
                                        }
                             //verificar si esta registrado el elemento.
                              $existeElemento=  $elementosControlador->VerificarExistencia( $item['element_id'] );
                             if(!$existeElemento)
                             {
                               $nuevoElemento =  new Elementos;
                               $nuevoElemento->id = $item['element_id'];
                               $nuevoElemento->simbolo = $item['symbol'];
                               $nuevoElemento->descripcion = $item['element_symbol']." ".$item['element_name'];
                               $nuevoElemento->estaactivo = true;
                               $nuevoElemento->id_usuariocreo = 1;
                              $nuevoElemento->save();
                                echo "----------------Se Creo una nuevo elemento--------------------".'<br>';
                              $existeElemento =true;
                             }

                      //Verificacion de existencia de ValoresElementos.
                      $listaDeValoresElementos = array([]);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'estaciones_id', $item['station_id']);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'elementos_id', $item['element_id']);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'unidaddemedida_simbolo', $item['symbol']);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'fechaestacion', $item['datetime']);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'valor', $item['valor']);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'estaactivo', true);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'dia', $dia);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'mes', $mes);
                      $listaDeValoresElementos = array_add($listaDeValoresElementos, 'anio', $anio);
                      $valoresElementosControler= new ValoresElementosControler();
                      $existenValoresElementos = $valoresElementosControler->VerificarExistencia($listaDeValoresElementos);
                      //Si no esta registrado en la base de datos se registra
                       $valoreselementos_id=0;
                    if($existenValoresElementos != 1)
                      {
                      $valoreselementos_id =  $valoresElementosControler->store($listaDeValoresElementos);
                          echo ' ---------se registro en valoresElementos       '.'<br>';
                      }




}
   }//fin Fase fenologica.
}//Fin de tipo de productos


  }














}
