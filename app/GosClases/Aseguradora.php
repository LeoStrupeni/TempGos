<?php
namespace GosClases;

use App\Gos\Gos_Aseguradora;
use Session;

/**
 * Clase para Las aseguradoras
 *
 */
class Aseguradora extends GosData
{

    /**
     * devuelve las aseguradoras
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaAseguradoras()
    {
        $idtaller=Session::get('taller_id');
        return Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
    }
}
