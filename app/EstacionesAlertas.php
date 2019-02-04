<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstacionesAlertas extends Model
{
  protected $table ='estacionesalertas';
protected $fillable =['valoreselementos_id','tipodealerta_id', 'created_at','updated_at'];
}
