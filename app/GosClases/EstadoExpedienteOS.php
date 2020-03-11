<?php
namespace GosClases;

use App\Gos\Gos_OS_Estado_Exp;

/**
 * Clase de gestion de estado de expedientes de OS
 *
 * @author yois
 *        
 */
class EstadoExpedienteOS extends GosData
{

    /**
     * devuelve lista de estado de expediente OS
     * 
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaEstadoExpOS()
    {
        return Gos_OS_Estado_Exp::all();
    }
}

