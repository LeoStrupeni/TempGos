<?php
namespace GosClases;

use App\Gos\Gos_Compra_Item;

/**
 * clase que gestiona las compras
 *
 * @author yois
 *        
 */
class Compras extends GosData
{

    /**
     * Agregar item de compra
     *
     * @param unknown $request            
     * @return NULL|\App\Gos\Gos_Compra_Item
     */
    public static function agregaItem($request)
    {
        $item = null;
        $gos_producto_id = isset($request->gos_producto_id) ? $request->gos_producto_id : 0;
        $datos = self::datosItem($request);

        $item = new Gos_Compra_Item($datos);
        $item->save();

        // si hay un id de producto mayor a cero
        // if ($gos_producto_id > 0) {
        //     // buscar el item si existe
        //     $item = Gos_Compra_Item::find($gos_producto_id);
        //     // si existe guardar los datos
        //     $existe = isset($item->gos_producto_id);
        //     if ($existe) {
        //         // si existe guardar los datos
        //         $item->update($datos);
        //     } else {
        //         // si no existe agregar los datos
        //         $item = new Gos_Compra_Item($datos);
        //         $item->save();
        //     }
        // }
        return $item;
    }

    /**
     *
     * @param unknown $request            
     * @return unknown[]|number[]|NULL[]
     */
    private static function datosItem(Request $request)
    {
        // gos_compra_item_id int(11) AI PK 
        // gos_compra_id int(11) 
        // gos_producto_id int(11) 
        // cantidad double(16,2) 
        // costo double(16,2) 
        // iva double(16,2) 
        // precio_venta double(16,2) 
        // descuento double(16,2)
        $descuento = isset($request->descuento) ? $request->descuento : 0;
        $iva = isset($request->iva) ? $request->iva : 0;
        $subtotal = $request->cantidad * $request->$costo;
        return [
            'gos_compra_id' => $request->gos_compra_id_item,
            'gos_producto_id' => $request->$gos_producto_id,
            'gos_producto_marca_id' => $request->$gos_producto_marca_id,
            'nomb_producto' => $request->$nomb_producto,
            'cantidad' => $request->cantidad,
            'precio' => $request->$costo,
            'descuento' => $descuento,
            'subtotal' => $subtotal,
            'iva' => $iva
        ];
    }

    /**
     * borra item de compra
     *
     * @param unknown $gos_compra_item_id            
     * @return unknown|NULL
     */
    public static function borra($gos_compra_item_id)
    {
        $etapa = Gos_Compra_Item::find($gos_compra_item_id);
        if ($etapa) {
            return $etapa->delete();
        } else
            return null;
    }
}
