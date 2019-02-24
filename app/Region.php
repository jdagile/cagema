<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $table ='region';
  protected $fillable =['descripcion', 'id_tipodeatura', 'estaactivo','id_usuariocreo','created_at','regions_id'];
}
