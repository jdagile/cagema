<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelDeAlerta extends Model
{
  protected $table ='niveldealerta';
  protected $fillable =['descripcion','estaactivo','id_usuariocreo','created_at'];
}
