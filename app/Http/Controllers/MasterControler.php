<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Elementos;
use App\UnidadDeMedida;
use App\Estaciones;
use App\ValoresElementos;
use Carbon\Carbon;
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
echo "----------------UnidadesDeMedidas--------------------".'<br>';
    foreach ($unidadesDeMedidas as $unidad) {
            $valor=  $unidad['simbolo'];
            echo ' ---------       '.$valor.'<br>';
    }
//Elementos.
$elementosControlador= null;
$elementosControlador = new ElementosControler();
$elementos =$elementosControlador->ObtenerTodos();
echo "----------------Elementos--------------------".'<br>';
foreach ($elementos as $elemento) {
        $valor=  $elemento['simbolo'];
        echo ' ---------       '.$valor.'<br>';
}
//estaciones.
$estaciones=null;
$estacionesControler= new EstacionesControler();
$estaciones= $estacionesControler->ObtenerTodos();
echo "----------------Estaciones--------------------".'<br>';
foreach ($estaciones as $estacion) {
        $valor=  $estacion['descripcion'];
        echo $estacion['id']." ".$estacion['descripcion'].'<br>';
}

    //llamar el metodo DatosDeUltimaHora es el que cosumenel API en el controlador ConsumirApiDeCICOHControler
     $datosDeUltimaHora =null;
     $controlador =null;
     $controlador = new ConsumirApiDeCICOHControler();
     $items = $controlador->DatosDeUltimaHora();
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
                             //Verificar el registro de la estacion.
                             $exixteLaEstacion=false;
                              $estacionesControler= new EstacionesControler();
                              $exixteLaEstacion= $estacionesControler->VerificarExistencia($item['station_id'] );
                             if($exixteLaEstacion == false)
                             {
 echo "----------------hay estacion nueva-------------------".'<br>';
                               $nuevaEsacion= new Estaciones();
                               $nuevaEsacion->id=$item['station_id'];
                               $nuevaEsacion->descripcion = $item['station_name'];
                               $nuevaEsacion->latitud =$item['latitude'];
                               $nuevaEsacion->longitud =$item['longitude'];
                               $nuevaEsacion->elevacion =$item['elevation'];
                               $nuevaEsacion->estaactivo = true;
                               $nuevaEsacion->id_usuariocreo = 1;
                               $nuevaEsacion->save();
                               $exixteLaEstacion =true;
     echo "----------------Se Creo una nueva estacion--------------------".'<br>';
                             }

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
                      //ObtenerParametrosDeProductoFaseElementoRango

                      //Obener información de la tabla ProductoFaseElementoRango
                      $productoFaseElementoRangosfiltro = array([]);
                      $productoFaseElementoRangosfiltro = array_add($productoFaseElementoRangosfiltro, 'tipoproducto_id', $tipoProducto['id']);
                      $productoFaseElementoRangosfiltro = array_add($productoFaseElementoRangosfiltro, 'fasefenologica_id', $fase['fasefenologica_id']);
                      $controladorProductoFaseElementoRango =null;
                      $controladorProductoFaseElementoRango =  new ProductoFaseElementoRangoControler();
                      $productoFaseElementoRangos = $controladorProductoFaseElementoRango->ObtenerParametrosDeProductoFaseElementoRango($productoFaseElementoRangosfiltro);
  echo ' ---------se consulto en $productoFaseElementoRangos       '.'<br>';

                     foreach($productoFaseElementoRangos as $productoFaseElementoRango)
                     {
                   echo $valoreselementos_id;
                      if($valoreselementos_id >0)//tiene que registrar nuevos valores elementos.
                     {

                     if(  ($item['element_id']== $productoFaseElementoRango['elementos_id'])  )
                     {

//Validacion de valor contra Rango.
if ($item['valor'] >= $productoFaseElementoRango['valorminimo'] && $item['valor'] <= $productoFaseElementoRango['valormaximo']) {
  $estacionesAlertasValores = array([]);
  $estacionesAlertasValores =array_add($estacionesAlertasValores, 'valoreselementos_id', $valoreselementos_id);
  $estacionesAlertasValores =array_add($estacionesAlertasValores, 'tipodealerta_id', $productoFaseElementoRango['tipodealerta_id']);
  $estacionesAlertasControler = new EstacionesAlertasControler();
  $estacionesAlertas = $estacionesAlertasControler->store($estacionesAlertasValores);
      echo ' ---------se registro en estacionesAlertas       '.'<br>';
  echo $item['valor'].$item['symbol']." "." Se registro una alerta entre el valor minimo : ".$productoFaseElementoRango['valorminimo']."--y el valor maximo : ".$productoFaseElementoRango['valormaximo'].'<br>';

}
//Fin De validacion de valor contra Rango






                     }
                    }

                   }

}
   }//fin Fase fenologica.
}//Fin de tipo de productos


return view('prueba');
  }














}
