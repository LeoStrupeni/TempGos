<?php
namespace GosClases;

use App\Gos\Gos_OS_Tipo_Danio;

/**
 * Clase para gestionar los tipos de daños
 *
 * @author yois
 *        
 */
class TipoDanio extends GosData
{

    /**
     * devuelve lista de estado de tipos de daños
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaTipoDanio()
    {
        return Gos_OS_Tipo_Danio::all();
    }
}

