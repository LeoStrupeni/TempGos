<?php
namespace GosClases;

use App\Gos\Gos_Proveedor;
use Session;

/**
 * Clase para Las aseguradoras
 *
 */
class Proveedor extends GosData
{

    /**
     * devuelve las aseguradoras
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listarProveedores()
    {
        $idtaller=Session::get('taller_id');
        return Gos_Proveedor::where('gos_taller_id',$idtaller)->get();
    }
}
