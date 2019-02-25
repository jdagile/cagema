<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseFenologica extends Model
{
  protected $table ='fasefenologica';
  protected $fillable =['descripcion', 'regions_id', 'estaactivo','id_usuariocreo','created_at' ,'fechainicio','fechafin'];
}
