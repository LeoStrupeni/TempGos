<?php
namespace GosClases;

use App\Gos\Gos_V_Total_Tipo_Os;

/**
 * Clase con funciones utiles para el reporte de utilidad
 *
 * @author yois
 *
 */
class ReporteUtilidad extends Reportes
{
  /**
   * Para desplegar ddatos del grafico de utilidad por unidad
   */
    // public static function traerDatosGraficoUtilidad() {
    //
    // }

    /**
     * Para desplegar datos de la tabla de utilidad por unidad
     */
    // public static function listarItemsUtilidad() {
    //
    // }

    public static function TipoOS()
    {
        return Gos_V_Total_Tipo_Os::select('item')->get();
    }
}
