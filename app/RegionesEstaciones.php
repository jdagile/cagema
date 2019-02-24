<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionesEstaciones extends Model
{
  protected $table ='regionesestaciones';
  protected $fillable =['region_id','estaciones_id','estaactivo','id_usuariocreo','created_at'];
}
