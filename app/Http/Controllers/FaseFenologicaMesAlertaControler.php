<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaseFenologicaMesAlerta;
use App\Http\Requests;
class FaseFenologicaMesAlertaControler extends Controller
{

    public function ObtenerParametrosDeFaseFenologicaMesAlerta($meses_id,$tipodeproducto_id)
   {
        try {
          $ResultadoFaseFenologicaMesAlerta =null;
         $ResultadoFaseFenologicaMesAlerta = FaseFenologicaMesAlerta::where('meses_id', '=', $meses_id)
              ->where('tipodeproducto_id', '=', $tipodeproducto_id)->get();

            return $ResultadoFaseFenologicaMesAlerta;
            } catch (\Exception $e) {
  }
}

}
