<?php
namespace GosClases;

use App\Gos\Gos_V_Resumen_Estado_Os;
use App\Gos\Gos_V_Total_Tipo_Os;
use App\Gos\Gos_V_Reporte_Orden_Servicio;

/**
 *
 * @author yois + Sol
 *
 */
class ReporteOSProcesadas extends Reportes
{

    /**
     * Devuelve resumen de OS por estado de expediente
     *
     * @param array $filtros
     * @return unknown
     */
    public static function resumenEstadoOS($filtros = array())
    {
        // TODO: NO ALAMBRAR FORMULAS DENTRO DEL CODIGO
        $formula = 'count(*) as cantidad, estado';
        $groupBy = 'estado';
        $resultados = Gos_V_Resumen_Estado_Os::selectRaw($formula)->groupBy($groupBy)->get();
        // Si hay flitros
        if (count($filtros) > 0) {
            // aplicar filtros
            $resultados = Gos_V_Resumen_Estado_Os::selectRaw($formula)->whereColumn($filtros)
                ->groupBy($groupBy)
                ->get();
        }
        return $resultados;
    }

    /**
     *
     * @param array $filtros
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function totalTipoOS($filtros = array())
    {
        $resultados = Gos_V_Total_Tipo_Os::all();
        // Si hay flitros
        if (count($filtros) > 0) {
            // aplicar filtros
            $resultados = Gos_V_Total_Tipo_Os::whereColumn($filtros)->get();
        }
        return $resultados;
    }

    public static function listarOSProcesadas ()
    {
      $resultados = Gos_V_Reporte_Orden_Servicio::all();
      return $resultados;
    }
}
