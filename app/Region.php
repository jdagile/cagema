<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $table ='regions';
  protected $fillable =['descripcion', 'regions_id', 'estaactivo','id_usuariocreo','created_at','regions_id'];
}
