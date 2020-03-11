<?php
namespace GosClases;

use App\Gos\Gos_OS_Refaccion_Estatus;

/**
 * Clase para Las aseguradoras
 *
 */
class RefaccionStatus extends GosData
{

    /**
     * devuelve las aseguradoras
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listarRefaccionStatus()
    {
        return Gos_OS_Refaccion_Estatus::all();
    }
}
