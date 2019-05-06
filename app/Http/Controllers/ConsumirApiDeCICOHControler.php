<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ConsumirApiDeCICOHControler extends Controller
{
  public function index()
  {

  }

  public function DatosDeUltimaHora()
  {
    header("Content-type:text/html;charset=\"utf-8\"");
    $previsionTiempo = ""; $error="";
    $urlContents = file_get_contents("http://138.68.55.125:8080/api/v2/cicoh/_table/v_api_lasthour?include_count=true&api_key=74866bf219af9c58496bab86a3360fe071fd6cecd866d3f0721550dfdc69fbe5");
       $array = json_decode($urlContents,true);
       return  $array;
  }
  public function DatosDeEstaciones()
  {
    header("Content-type:text/html;charset=\"utf-8\"");
    $previsionTiempo = ""; $error="";
    $urlContents = file_get_contents("http://138.68.55.125:8080/api/v2/cicoh/_table/stations?api_key=74866bf219af9c58496bab86a3360fe071fd6cecd866d3f0721550dfdc69fbe5");
       $array = json_decode($urlContents,true);
       return  $array;
  }



}
