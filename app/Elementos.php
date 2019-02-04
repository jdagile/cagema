<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elementos extends Model
{
  protected $table ='elementos';
  protected $fillable =['simbolo','descripcion','estaactivo','id_usuariocreo','created_at'];
}
