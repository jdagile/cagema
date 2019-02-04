<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValoresAcumuladosPorFaseFenologica extends Model
{
    protected $table ='valoresacumuladosporfasefenologicas';
      protected $fillable =['tipodeproducto_id','fasefenologica_id','elementos_id','valor','estaactivo','id_usuariocreo','created_at'];

public function producto()
{
  return $this->belongsTo(TipoDeProducto::class);

}

}
