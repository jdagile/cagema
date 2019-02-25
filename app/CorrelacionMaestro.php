<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelacionMaestro extends Model
{
  protected $table ='correlacionmaestro';
  protected $fillable =['descripcion','tipodeproducto_id','fasefenologica_id','alertasgenerales_id','estaactivo','id_usuariocreo','created_at'];
}
