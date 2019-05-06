<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estaciones extends Model
{
  protected $table ='estaciones';
  protected $fillable =['descripcion','longiud','latitud','elevacion','departamentos_id','municipios_id','cuencas_id','perfil_id','estaactivo','id_usuariocreo','created_at'];

}
