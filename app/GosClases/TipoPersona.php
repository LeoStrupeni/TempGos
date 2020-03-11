<?php
namespace GosClases;

use App\Gos\Gos_Fac_Tipo_Persona;

/**
 * Clase para gestionar tipos de personas
 *
 * @author yois
 *        
 */
class TipoPersona extends GosData
{

    /**
     * devuelve lista de personas
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaTipoPersonas()
    {
        return Gos_Fac_Tipo_Persona::all();
    }
}

