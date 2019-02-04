<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValoresElementos extends Model
{
  protected $table ='valoreselementos';
  protected $fillable =['estaciones_id','elementos_id','unidaddemedida_simbolo','fechaestacion','valor', 'estaactivo','dia','mes','anio'];
}
