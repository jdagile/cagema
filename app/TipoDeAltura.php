<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeAltura extends Model
{
  protected $table ='tipodealtura';
  protected $fillable =['descripcion','estaactivo','id_usuariocreo','created_at'];
}
