<?php
namespace GosClases;

use App\Gos\Gos_Paquete;
use App\Gos\Gos_V_Min_Paq_etapas;
use App\Gos\Gos_V_Lic_Paq_Etapas;
use App\Gos\Gos_V_Lic_Paq_Servicio;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_Usuario_Tecnico;
use Illuminate\Http\Request;
use \Response;
use Session;
/**
 * Clase para gestionar Paquetes
 *
 * @author yois
 *        
 */
class Paquete extends GosData
{

    /**
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function obtenPaquete($gos_paquete_id)
    {
        $p = Gos_Paquete::where('gos_paquete_id', $gos_paquete_id)->first();
        return Response::json($p);
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_Paquete::where(self::condIdTaller());
    }

    /**
     *
     * @return array
     */
    protected static function preparaCrearEditar()
    {
        // para el modal de edicion de Paquete
        $listadoEtapas = Gos_V_Lic_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->orWhere('gos_taller_id', 0);
        $listadoServicios = Gos_V_Lic_Paq_Servicio::where('gos_taller_id',Session::get('taller_id'))->orWhere('gos_taller_id', 0);
        $listadoAsesores = Gos_Usuario_Tecnico::all();
        //
        return compact('listadoEtapas', 'listadoServicios', 'listadoAsesores');
    }

    /**
     *
     * @return \GosClases\unknown|\GosClases\NULL|\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function preparaVistaListado()
    {
        $compact = self::preparaCrearEditar();
        /**
         * preparar ajax
         */
        //
        $ajax = self::preparaDataTableAjax(self::listadoGeneral(), 'Paquetes.OpcionesPaquetesDatatable');
        if (null !== $ajax) {
            return $ajax;
        }
        //
        return view('Paquetes/ListarPaquetes', $compact);
    }

    /**
     *
     * @param unknown $request            
     * @return NULL|\App\Gos\Gos_Paquete
     */
    protected static function guardaEntidadPrincipal($request)
    {
        $p = null;
        $gos_paquete_id = isset($request->gos_paquete_id) ? $request->gos_paquete_id : 0;
        //
        $datos = self::datosEntidad($request);
        // dd($datos);
        if ($gos_paquete_id > 0) {
            $p = Gos_Paquete::find($gos_paquete_id)->update($datos);
        } else {
            $p = new Gos_Paquete($datos);
            $p->save();
            $gos_paquete_id = $p->gos_paquete_id;
        }
        return $p;
    }

    /**
     *
     * @param Request $request            
     * @param number $id            
     * @return unknown
     */
    public static function guardaJson(Request $request, $id = 0)
    {
        return Response::json(self::guardaEntidadPrincipal($request));
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]|string[]
     */
    public static function datosEntidad($request)
    {
        $codigo_sat = isset($request->codigo_sat) ? $request->codigo_sat : '0.00';
        return [
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_paquete' => $request->nomb_paquete,
            'descripcion_paquete' => $request->descripcion_paquete,
            'precio_paquete' => $request->precio_paquete,
            'codigo_sat' => $codigo_sat
        ];
    }

    /**
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function borraPaquete($gos_paquete_id)
    {
        $paquete = Gos_Paquete::find($gos_paquete_id)->delete();
        return $paquete;
    }
}

