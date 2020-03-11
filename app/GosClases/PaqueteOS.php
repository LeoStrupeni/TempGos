<?php
namespace GosClases;

use App\Gos\Gos_Paquete;
use App\Gos\Gos_V_Min_Paq_etapas;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_V_Lic_Paq_Etapas;
use App\Gos\Gos_V_Lic_Paq_Servicio;
use Illuminate\Http\Request;
use \Response;
use App\Gos\Gos_V_Items_Paquetes;
use App\Gos\Gos_Os_Item;
use Session;
use App\Gos\Gos_V_Paq_Etapas;
use App\GosClases\GosUtil;

/**
 * Clase para gestionar paquetsde dentro de la OS
 *
 * @author yois
 *        
 */
class PaqueteOS extends GosDataTable
{

    /**
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function obtenPaquete($gos_paquete_id)
    {
        
        return Gos_Paquete::where('gos_paquete_id', $gos_paquete_id)->first();
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        $taller_id = Session::get('taller_id');
        return Gos_Paquete::where('gos_taller_id', $taller_id)->orWhere('gos_taller_id', 0);
    }

    /**
     *
     * @return array
     */
    public static function preparaCrearEditar()
    {
        // para el modal de edicion de Paquete
        $tallerID = GosUtil::tallerIdActual();
        // Listados tomados de la lista de Etapas y servicios Migrados desde Licencias y no desde Licencias
        $listadoEtapas = Gos_V_Paq_Etapas::where('gos_taller_id', $tallerID)->get();
        $listadoServicios = Gos_V_Paq_Servicios::where('gos_taller_id', $tallerID)->get();
        //
        $rolTecnico = GosSistema::rolTecnico();
        //
        $idtaller=Session::get('taller_id');
        $listadoAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id', 1)->get();
        //
        return compact('listadoEtapas', 'listadoServicios', 'listadoAsesores');
    }

    /**
     *
     * @param unknown $request            
     * @return NULL|\App\Gos\Gos_Paquete
     */
    public static function guardaEntidadPrincipal($request)
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
     * @param unknown $request            
     * @return number[]|NULL[]|string[]
     */
    public static function datosEntidad($request)
    {
        $codigo_sat = isset($request->codigo_sat) ? $request->codigo_sat : '0';
        return [
            'gos_taller_id' => Session::get('taller_id'),
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
    public static function borraPaqueteOS($gos_paquete_id)
    {
        $paquete = Gos_Paquete::find($gos_paquete_id)->delete();
        return Response::json($paquete);
    }

    public static function borraPaquete($gos_paquete_id)
    {
        $paquete = Gos_Paquete::find($gos_paquete_id)->delete();
        return Response::json($paquete);
    }

    /**
     * Prepara y guarda datos de paquete a ser agregado como Item
     *
     * @param unknown $gos_os_id            
     * @param unknown $gos_paquete_id            
     */
    public static function preparaGuardaPaquete($gos_os_id, $gos_paquete_id)
    {
        $etapas = Gos_V_Items_Paquetes::where('gos_paquete_id', $gos_paquete_id)->orderByRaw('orden_etapa DESC')->get();
        
        // dd($etapas);
        $nuevosDatos['gos_os_id'] = $gos_os_id;
        $nuevosDatos['gos_paquete_id'] = $gos_paquete_id;
        $yaExisteEtapaEnOs = true;
        $finalOS = 0;
        // consultar items del paqeute elegido
        // recorrer todos los items del paqeute
        foreach ($etapas as $etapa) {
            $datos = PaqueteItems::datosEntidad($etapa);
            $nuevosDatos['gos_paq_etapa_id'] = $etapa->gos_paq_etapa_id;
            $nuevosDatos['gos_paq_servicio_id'] = $etapa->gos_paq_servicio_id;
            $gos_paq_etapa_id = $etapa->gos_paq_etapa_id;
            
            // consultar si existe el paquete
            $etapaEncontrada = Gos_Os_Item::where('gos_os_id', $gos_os_id)->where('gos_paq_etapa_id', $etapa->gos_paq_etapa_id)->first();
            // si existe
            // $yaExisteEtapaEnOs = $etapaEncontrada->gos_paq_etapa_id;
            if ($yaExisteEtapaEnOs) {
                
                $etapa = new Gos_Os_Item($nuevosDatos);
                $etapa->save();
                $finalOS = $etapa->gos_os_item_id;
            }
        }
        $gos_item = Gos_Os_Item::find($finalOS);
        $gos_item->estado_etapa = 'A';
        date_default_timezone_set('America/Mexico_City');
       
        $gos_item->fecha_inicio_et = date("Y-m-d H:i:s");
        $gos_item->save();
        return $nuevosDatos;
    }
}

