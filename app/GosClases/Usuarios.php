<?php
namespace GosClases;

use App\GosClases\GosUtil;
use App\Gos\Gos_Usuario;
use App\Gos\Gos_V_Usuarios;

/**
 * clase para gestionar usuarios del sistema
 *
 * @author yois
 *        
 */
class Usuarios extends GosData
{

    /**
     * devuelve lista de asesores tecnicos del taller actual
     *
     * @return unknown
     */
    public static function listaAsesoresTaller()
    {
        $gos_usuario_rol_id = GosSistema::rolTecnico();
        $gos_taller_id = GosUtil::tallerIdActual();
        $criBusq = [
            [
                'gos_taller_id',
                '=',
                $gos_taller_id
            ],
            [
                'gos_usuario_rol_id',
                '=',
                $gos_usuario_rol_id
            ]
        ];
        return Gos_V_Usuarios::where($criBusq)->orderBy('nombre_apellidos')->pluck('gos_usuario_id', 'nombre_apellidos');
    }
}

