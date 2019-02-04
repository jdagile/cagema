<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductoFaseElementoRango extends Model
{
  protected $table ='productofaseelementorango';
  protected $fillable =['tipoproducto_id','fasefenologica_id','elementos_id','tipodealerta_id','tipodealtura_id','valorminimo','valormaximo','estaactivo'];
}
