<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeAlerta extends Model
{
  protected $table ='tipodealerta';
  protected $fillable =['descripcion','estaactivo','id_usuariocreo','created_at'];
}
