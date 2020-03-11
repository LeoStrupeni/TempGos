<?php
namespace GosClases;

use App\Gos\Gos_Os_Encuesta;

/**
 *
 * @author yois + Sol
 *
 */
class ReporteEncuestaOS extends Reportes
{

    /**
     * Devuelve resumen de OS por estado de expediente
     *
     * @param array $filtros
     * @return unknown
     */
    public static function listasGraficosEcuestas()
    {
        // listaCumplioFechaPromesa
        $formula = 'count(*) as cantidad, cumplio_fecha_promesa';
        $groupBy = 'cumplio_fecha_promesa';
        $listaCumplioFechaPromesa = Gos_Os_Encuesta::selectRaw($formula)->groupBy($groupBy)->get();

        // listaCalidadAtencionCdr
        $formula = 'count(*) as cantidad, calidad_atencion_cdr';
        $groupBy = 'calidad_atencion_cdr';
        $listaCalidadAtencionCdr = Gos_Os_Encuesta::selectRaw($formula)->groupBy($groupBy)->get();

        // listaImformadoProcesoReparacion
        $formula = 'count(*) as cantidad, imformado_proceso_reparacion';
        $groupBy = 'imformado_proceso_reparacion';
        $listaImformadoProcesoReparacion = Gos_Os_Encuesta::selectRaw($formula)->groupBy($groupBy)->get();

        // listaRecomendacionCdr
        $formula = 'count(*) as cantidad, recomendacion_cdr';
        $groupBy = 'recomendacion_cdr';
        $listaRecomendacionCdr = Gos_Os_Encuesta::selectRaw($formula)->groupBy($groupBy)->get();

        // dd(compact('listaCumplioFechaPromesa','listaCalidadAtencionCdr','listaImformadoProcesoReparacion','listaRecomendacionCdr'));
        return compact('listaCumplioFechaPromesa','listaCalidadAtencionCdr','listaImformadoProcesoReparacion','listaRecomendacionCdr');
    }

}
