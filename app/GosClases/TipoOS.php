<?php
namespace GosClases;

use App\Gos\Gos_OS_Tipo_O;

/**
 * clase para gestionar los tipos de Ordenes de Servicios
 *
 * @author yois
 *        
 */
class TipoOS extends GosData
{

    /**
     * devuelve lista de tipos de ordenes de servicios
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaTipoOS()
    {
        return Gos_OS_Tipo_O::all();
    }
}

