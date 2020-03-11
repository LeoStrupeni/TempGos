<?php
namespace GosClases;

use App\GosClases\GosUtil;
use App\Gos\Gos_OS_Anticipo;
use App\Gos\Gos_V_Os_Anticipos;

/**
 *
 * @author yois
 *        
 */
class Anticipo extends GosData
{

    /**
     *
     * @param unknown $item            
     * @return NULL[]|unknown[]
     */
    public static function datosEntidad($item)
    {
        $fecha_abono = GosUtil::convierteFechaHaciaMySQLFormat($item->fecha_abono);
        $gos_os_id = $item->gos_os_id_anticipo;
        $observaciones = isset($item->observacionesAnticipo) ? $item->observacionesAnticipo : '';
        $gos_metodo_pago_id = isset($item->gos_metodo_pago_id) ? $item->gos_metodo_pago_id : 0;
        return [
            'gos_os_id' => $gos_os_id,
            'fecha_abono' => $fecha_abono,
            'monto_abono' => $item->monto_abono,
            'observaciones' => $observaciones,
            'gos_forma_pago_id' => $gos_metodo_pago_id
        ];
    }

    /**
     *
     * @param unknown $request            
     * @return NULL|\App\Gos\Gos_OS_Anticipo
     */
    public static function guardaDatosEntidad($request)
    {
        $a = null;
        $gos_os_id = isset($request->gos_os_anticipo_id) ? $request->gos_os_anticipo_id : 0;
        //
        $datos = self::datosEntidad($request);
        if ($gos_os_id > 0) {
            $a = Gos_OS_Anticipo::find($gos_os_id)->update($datos);
        } else {
            $a = new Gos_OS_Anticipo($datos);
            $a->save();
        }
        return $a;
    }

    /**
     * devuelve lista de anticipos segun orden de servicio
     *
     * @param integer $gos_os_id
     *            identificador de orden de servicio
     * @return \GosClases\unknown|\GosClases\NULL
     */
    public static function otbtenAnticiposPorOS($gos_os_id)
    {
        $l = Gos_V_Os_Anticipos::where('gos_os_id', $gos_os_id)->get();
        return $l;
    }

    /**
     *
     * @param unknown $gos_os_anticipo_id            
     * @return unknown
     */
    public static function borraItemOS($gos_os_anticipo_id)
    {
        $a = Gos_OS_Anticipo::find($gos_os_anticipo_id);
        if ($a) {
            $a->delete();
        }
        
        return $a;
    }
}

