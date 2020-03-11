<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\Producto;
use GosClases\Compras;
use App\Gos\Gos_Proveedor;
use App\Gos\Gos_V_Compras;
use App\Gos\Gos_V_Compras_Items;
use App\Gos\Gos_Compra;
use App\Gos\Gos_Compra_Item;
use App\Gos\Gos_Compra_Administrativa;
use App\Gos\Gos_V_Min_Proveedores;
use App\Gos\Gos_Producto;
use App\Gos\Gos_V_Min_Inventario;
use App\Gos\Gos_Forma_Pago;
use App\Gos\Gos_Compra_Tipo;
use App\Gos\Gos_Metodo_Pago;
use App\Http\Controllers\Gos\OS\ItemOSController;
use App\Gos\Gos_Producto_Ubic_Stock;

class ComprasItemsController extends GosControllers
{
    protected $opcionesEditDataTable = 'Compras.OpcionesItemsComprasDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_compra_id)
    {
        $listadoItems = Gos_V_Compras_Items::where('gos_compra_id',$gos_compra_id)->get();
        $ajax = $this->preparaDataTableAjax($listadoItems, $this->getOpcionesEditDataTable());
        return $ajax;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_compra_item_id)
    {
        // $item = Gos_Compra_Item::find($gos_compra_item_id);
        // if ($item === null) {
        //     $item = Gos_Compra_Administrativa::find($gos_compra_item_id);
        //     $item->delete();
        // }
        // else{
        //     $item->delete();
        // }
        // return Response::json($item);
    }

    public function borrarItem(Request $request)
    {
        $item=null;
        if($request->Tipo == 'adm'){
            $item = Gos_Compra_Administrativa::find($request->Id);
            $item->delete();
        } else {
            $item = Gos_Compra_Item::find($request->Id);
            $item->delete(); 

            $ubicacion = Gos_Producto_Ubic_Stock::where('gos_producto_id',$request->Producto)->first();
            $cantidad = $ubicacion['ingreso']-$request->Cantidad > 0 ? $ubicacion['ingreso']-$request->Cantidad : 0;
            $fecha = date('Y-m-d'); 
            $ubicacionStock = Gos_Producto_Ubic_Stock::find($ubicacion['gos_producto_ubic_stock_id'])->update([
                'ingreso' => $cantidad,
                'fecha' => $fecha
            ]);

        }
        return Response::json($item);
    }
}