<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeProducto extends Model
{
  protected $table ='tipodeproducto';
  protected $fillable =['id','descripcion','estaactivo','id_usuariocreo','created_at'];
}
