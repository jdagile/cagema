<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelacionDetalle extends Model
{
  protected $table ='correlaciondetalle';
  protected $fillable =['correlacionmaestro_id','tipoproducto_id','tipodealerta_id','estaactivo','id_usuariocreo','created_at'];
}
