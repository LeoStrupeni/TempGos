<?php
namespace GosClases;
use Session;
use App\Gos\Gos_Taller_Conf_vehiculo;

/**
 * Clase padre de reportes util para reutilizar codigos de reportes
 *
 * @author yois
 *
 */
class Reportes
{

    /**
     * deveulve arreglo de variables con listas de seleccion de opciones de filtrado de reportes
     *
     * @return array
     */
    public static function listasSeleccionFiltrado()
    {
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();

        $listaSeleccionTipoPersona = TipoPersona::listaTipoPersonas();
        $listaSeleccionTipoOrden = TipoOS::listaTipoOS();
        $listaSeleccionTipoDanio = TipoDanio::listaTipoDanio();
        $listaSeleccionEstadoExpOs = EstadoExpedienteOS::listaEstadoExpOS();
        $listaAseguradoras = Aseguradora::listaAseguradoras();
        $listaTipoOS = ReporteUtilidad::TipoOS();
        $listaSeleccionProveedores = Proveedor::listarProveedores();
        $listaSeleccionRefaccionStatus = RefaccionStatus::listarRefaccionStatus();
        return compact('listaSeleccionTipoPersona', 'listaSeleccionTipoOrden', 'listaSeleccionTipoDanio', 'listaSeleccionEstadoExpOs','listaAseguradoras','listaTipoOS','listaSeleccionProveedores','listaSeleccionRefaccionStatus','taller_conf_vehiculo');
    }
}
