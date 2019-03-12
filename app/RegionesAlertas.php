<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionesAlertas extends Model
{
  protected $table ='regionesalertas';
  protected $fillable =['id','region_id','alertasgenerales_id','dia','mes','anio','estaactivo', 'id_usuariocreo','created_at'];
}
