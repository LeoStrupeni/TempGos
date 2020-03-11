<?php
namespace GosClases;

use App\Gos\Gos_Paquete;
use Illuminate\Http\Request;
use \Response;
use App\Gos\Gos_V_Items_Paquetes;
use App\Gos\Gos_Paquete_Item;

/**
 * Clase para manejar Paqetes de OS
 *
 * @author yois
 *        
 */
class PaqueteItems extends GosData
{

    /**
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function obtenItemPaquete($gos_paquete_id)
    {
        $p = Gos_Paquete_Item::where('gos_paquete_id', $gos_paquete_id)->first();
        return $p;
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral()
    {
        return Gos_V_Items_Paquetes::where(self::condIdTaller());
    }

    /**
     * devuelve items etapas desde un paquete
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function listaPorID($gos_paquete_id)
    {
        $d = Gos_V_Items_Paquetes::where('gos_paquete_id', $gos_paquete_id)->get();
        return $d;
    }

    /**
     *
     * @param unknown $request            
     * @return NULL|\App\Gos\Gos_Paquete
     */
    public static function guardaEntidadPrincipal($request)
    {
        /**
         *
         * @var unknown $p
         */
        $p = null;
        $gos_paquete_item_id = isset($request->gos_paquete_item_id) ? $request->gos_paquete_item_id : 0;
        //
        $datos = self::datosEntidad($request);
        if ($gos_paquete_item_id > 0) {
            $p = Gos_Paquete_Item::find($gos_paquete_item_id)->update($datos);
        } else {
            $p = new Gos_Paquete_Item($datos);
            $p->save();
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
        
        /**
         *
         * @var Ambiguous $codigo_sat
         */
        $gos_usuario_asesor_id = $request->gos_usuario_asesor_id !== null ? $request->gos_usuario_asesor_id : 0;
        $descuento = $request->descuento !== null ? $request->descuento : 0;
        $link = $request->link !== null ? $request->link : '';
        $asesor = $gos_usuario_asesor_id;
        $comision_asesor = $request->comision_asesor !== null ? $request->comision_asesor : 0.00;
        $tipoComPred = GosSistema::obtenTipoComision();
        $comision_asesor_tipo = $request->comision_asesor_tipo !== null ? $request->comision_asesor : $tipoComPred;
        $tiempo_meta = $request->tiempo_meta !== null ? $request->tiempo_meta : 0;
        $materiales = $request->materiales !== null ? $request->materiales : 0;
        $destajo = $request->destajo !== null ? $request->destajo : 0;
        $minimo_fotos = $request->minimo_fotos !== null ? $request->minimo_fotos : 0;
        $genera_valor = $request->genera_valor !== null ? $request->genera_valor : 0;
        $complemento = $request->complemento !== null ? $request->complemento : 0;
        $refacciones = $request->refacciones !== null ? $request->refacciones : 0;
        $gos_paquete_id = isset($request->gos_paquete_id_item) ? $request->gos_paquete_id_item : 0;
        $gos_paq_etapa_id = isset($request->gos_paq_etapa_id) ? $request->gos_paq_etapa_id : 0; 
        $gos_paq_servicio_id = isset($request->gos_paq_servicio_id) ? $request->gos_paq_servicio_id : 0;  
        // precios
        $precio_mo = isset($request->precio_mo) ? $request->precio_mo : 0;
        $precio_materiales = isset($request->precio_materiales) ? $request->precio_materiales : 0;
        $precio_servicio = isset($request->precio_servicio) ? $request->precio_servicio : 0;
        $precio_etapa = isset($request->precio_etapa) ? $request->precio_etapa : 0;
        //
        $servicio = isset($request->nomb_servicio) ? $request->nomb_servicio : '-';
        $descripcion = isset($request->descripcion_etapa) ? $request->descripcion_etapa : '-';
        return [
            'gos_paquete_id' => $gos_paquete_id,
            'gos_paq_etapa_id' => $gos_paq_etapa_id,
            'gos_paq_servicio_id' => $gos_paq_servicio_id,
            'gos_usuario_asesor_id' => $request->gos_usuario_asesor_id,
            'descuento' => $descuento,
            'codigo_sat' => $request->codigo_sat,
            'cantidad' => 1,
            'precio_etapa' => $precio_etapa,
            'precio_servicio' => $precio_servicio,
            'precio_materiales' => $precio_materiales,
            'precio_mo' => $precio_mo,
            'orden_etapa' => 0,
            //
            'comision_asesor' => $comision_asesor,
            'comision_asesor_tipo' => $comision_asesor_tipo,
            'tiempo_meta' => $tiempo_meta,
            'materiales' => $materiales,
            'destajo' => $destajo,
            'minimo_fotos' => $minimo_fotos,
            'genera_valor' => $genera_valor,
            'complemento' => $complemento,
            'refacciones' => $refacciones,
            'link' => $link
        ];
    }

    /**
     * borra item etapa del paquete
     *
     * @param unknown $gos_paquete_id            
     * @return unknown
     */
    public static function borraEtapa($gos_paquete_id)
    {
        $e = Gos_Paquete_Item::find($gos_paquete_id);
        $e->delete();
        return $e;
    }
}

