<?php
namespace GosClases;

use App\Gos\Gos_V_Reporte_Corte_Diario;

/**
 * Clase con funciones utiles para el reporte de utilidad
 *
 * @author yois
 *
 */
class ReporteCorteDiario extends Reportes
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

    public static function DetalleCorteDiario()
    {
        return Gos_V_Reporte_Corte_Diario::all();
    }
}
