<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseFenologicaMesAlerta extends Model
{
  protected $table ='fasefenologicamesalerta';
  protected $fillable =['fasefenologica_id','meses_id','tipodealerta_id','id_usuariocreo','id_usuariomodifico', 'created_at','updated_at'];
}
