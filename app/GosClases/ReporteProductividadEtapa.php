<?php
namespace GosClases;

use App\Gos\Gos_V_Reporte_Productividad_Etapa;

/**
 * Clase con funciones utiles para el reporte de utilidad
 *
 * @author yois
 *
 */
class ReporteProductividadEtapa extends Reportes
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

    public static function DetalleProductividadEtapa()
    {
        return Gos_V_Reporte_Productividad_Etapa::all();
    }
}
