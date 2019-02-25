<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertasGenerales extends Model
{
  protected $table ='alertasgenerales';
  protected $fillable =['id','descripcion','estaactivo','id_usuariocreo','created_at'];
}
