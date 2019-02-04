<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class ApiRestPruebasControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(isset($_GET["action"])){
      	if($_GET["action"] ==  "datos1") {
      		$this->getAlertasRecientes();
      	} else if($_GET["action"] ==  "datos2") {
      		$this->getAlertasCalendario();
      	} else if($_GET["action"] ==  "datos3") {
      		$this->getNotificaciones();
      	}
      }
        //
    }

    public function getNotificaciones() {
	$notificaciones = array();
	$resultado = array();
	if (($gestor = fopen("demo/alertas.csv", "r")) !== FALSE) {
		$fila=0;
	    while (($data = fgetcsv($gestor, 1000, ";")) !== FALSE) {
	    	$notificaciones[$fila]["Id"] = $fila;
	    	$notificaciones[$fila]["mensaje"] = utf8_encode($data[0]);
	    	$t = $this->calcularTiempo(str_replace("/","-",$data[7]), date('Y-m-d H:i:s'));
	        $notificaciones[$fila]["antiguedad"] = $t[0];
	        $notificaciones[$fila]["nueva"] = ($t[1]<60)?1:0;
	        $notificaciones[$fila]["tipo"] = utf8_encode($data[1]);
	        $fila++;
	        if($fila>=15){
	        	break;
	        }
	    }
	    fclose($gestor);
	}
	echo json_encode($notificaciones);
}

public function calcularTiempo($fecha1, $fecha2) {
	$date1 = new DateTime($fecha1);
	$date2 = new DateTime($fecha2);
	$diff = $date2->diff($date1);

	$segundos = $diff->h*60*60 + $diff->days*24*60*60 + $diff->i*60 + $diff->s;
	$tiempo = array();
	if($segundos >= 60) {
		if(($segundos/60)>=60){
			if(($segundos/60/60)>=24){
				$tiempo[] = intval($segundos/60/60/24)."d";
			} else {
				$tiempo[] = intval($segundos/60/60)."h";
			}
		} else {
			$tiempo[] = intval($segundos/60)."min";
		}
	} else {
		$tiempo[] = $segundos."s";
	}
	$tiempo[] = intval($segundos/60);
	return $tiempo;
}

public function getClassAlerta($tipo) {
	$cssClass = "m-fc-event--light m-fc-event--solid-";
	switch ($tipo) {
	    case "Alerta Roja":
	       $cssClass .= "danger";
	        break;
	    case 1:
	       $cssClass .= "warning";
	        break;
	    case 2:
	        $cssClass .= "info";
	        break;
	   default:
	   		$cssClass .= "primary";

	}
	return $cssClass;
}

public function getAlertasCalendario() {
	$alertas = array();
	$resultado = array();
	if (($gestor = fopen("demo/alertas.csv", "r")) !== FALSE) {
		$fila=0;
	    while (($data = fgetcsv($gestor, 1000, ";")) !== FALSE) {
	    	$alertas[$fila]["Id"] = $fila;
	    	$alertas[$fila]["title"] = utf8_encode($data[0]);
	        $alertas[$fila]["start"] =  date("Y-m-d H:i:s", strtotime(str_replace("/","-",$data[7])));
	        $alertas[$fila]["className"] = $this->getClassAlerta(utf8_encode($data[1]));
	       	$alertas[$fila]["description"] = utf8_encode($data[1])." - ".utf8_encode($data[0])." - Estacion:".utf8_encode($data[3])." - Elemento: ".utf8_encode($data[4])." - Valor: ".utf8_encode($data[5])." ".utf8_encode($data[6]);
	        $fila++;
	    }
	    fclose($gestor);
	}

	//$resultado["data"] = $alertas;
	echo json_encode($alertas);
}

public function getAlertasRecientes(){
	$alertas = array();
	$resultado = array();
	if (($gestor = fopen("demo/alertas.csv", "r")) !== FALSE) {
		$fila=0;
	    while (($data = fgetcsv($gestor, 1000, ";")) !== FALSE) {
	    	$alertas[$fila]["Id"] = $fila;
	    	$alertas[$fila]["Aviso"] = utf8_encode($data[0]);
	       	$alertas[$fila]["NivelAlerta"] = utf8_encode($data[1]);
	        $alertas[$fila]["ClassName"] = utf8_encode($data[2]);
	        $alertas[$fila]["Estacion"] = utf8_encode($data[3]);
	        $alertas[$fila]["Elemento"] = utf8_encode($data[4]);
	        $alertas[$fila]["Valor"] = $data[5];
	        $alertas[$fila]["UnidadMedida"] = utf8_encode($data[6]);
	        $alertas[$fila]["Fecha"] = utf8_encode($data[7]);
	        $fila++;
	    }
	    fclose($gestor);
	}

	$resultado["meta"] = array("total"=> count($alertas),"page"=>1,"pages"=>1,"perpage"=>-1,"sort"=>"asc","field"=>"Id");
	$resultado["data"] = $alertas;
	echo json_encode($resultado);
}


}
