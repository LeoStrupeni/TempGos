<?php
namespace GosClases;

use App\Gos\Gos_V_Min_Inventario;
use App\GosClases\GosUtil;
use Session;
/**
 * Clase para gestion de productos
 *
 * @author yois
 *        
 */
class Producto extends GosData
{

    /**
     * prepara datos para guardar producto como item
     *
     * @param unknown $request            
     * @return \GosClases\unknown[]|\GosClases\NULL[]|\GosClases\number[]|\GosClases\string[]
     */
    public static function datosItemProducto($request)
    {
        /**
         *
         * @var unknown $gos_os_id
         */
        $nombre = $request->nomb_producto;
        $descripcion = $request->descripcionProducto;
        $gos_producto_id = $request->gos_producto_id;
        $cantidad = $request->gos_producto_cantidad;
        $precio_materiales = $request->gos_producto_venta;
        $codigo_sat = $request->codigo_sat;
        //
        return [
            'nombre' => $nombre,
            'codigo_sat' => $codigo_sat,
            'cantidad' => $cantidad,
            'precio_materiales' => $precio_materiales
        
        ];
    }

    /**
     * devuelve lista de productos del inventario del taller
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaProductos()
    {
        return Gos_V_Min_Inventario::where('nomb_producto','<>','compra unica')
        ->where('gos_taller_id', Session::get('taller_id'))->orWhere('gos_taller_id',0)->get();
    }
}

