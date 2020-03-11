<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Producto_Ubic_Stock;
use App\Gos\Gos_V_Ubicaciones_Stock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Producto_Ubicacion;

/**
 *
 * @author yois
 *        
 */
class ProductosUbicStockControllers extends GosControllers
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listaUbicacionStock = self::listadoGeneral();
        $listaProductos = ProductosController::listaMinProductos();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        //
        return view('UbicacionesStock/ListarUbicacionStock', compact('listaUbicacionStock', 'listaProductos', 'listaUbicaciones'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Ubicaciones_Stock::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // obtener datos
        $listaProductos = ProductosController::listaMinProductos();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        //
        return view('UbicacionesStock/EditarUbicacionStock', compact('listaProductos', 'listaUbicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            // gos_producto_ubic_stock_id
            'gos_producto_id' => 'required',
            'gos_producto_ubicacion_id' => 'required',
            'ingreso' => 'required',
            'egreso' => 'required',
            'fecha' => 'required',
            'concepto' => 'required',
            'costo' => 'required'
        ]);
        
        $um = new Gos_Producto_Ubic_Stock([
            'gos_producto_id' => $request->get('gos_producto_id'),
            'gos_producto_ubicacion_id' => $request->get('gos_producto_ubicacion_id'),
            'ingreso' => $request->get('ingreso'),
            'egreso' => $request->get('egreso'),
            'fecha' => $request->get('fecha'),
            'concepto' => $request->get('concepto'),
            'costo' => $request->get('costo')
        ]);
        $um->save();
        
        return redirect()->route('ubicacionesstock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Ubic_Stock $gos_Producto_Ubic_Stock            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Producto_Ubic_Stock $gos_Producto_Ubic_Stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Ubic_Stock $gos_Producto_Ubic_Stock            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_producto_ubic_stock_id)
    {
        // obtener datos
        $ubicacionStock = Gos_Producto_Ubic_Stock::find($gos_producto_ubic_stock_id);
        $listaProductos = ProductosController::listaMinProductos();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        //
        return view('UbicacionesStock/EditarUbicacionStock', compact('ubicacionStock', 'listaProductos', 'listaUbicaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Producto_Ubic_Stock $gos_Producto_Ubic_Stock            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_Producto_Ubicacion_id)
    {
        $request->validate([
            // gos_producto_ubic_stock_id
            'gos_producto_id' => 'required',
            'gos_producto_ubicacion_id' => 'required',
            'ingreso' => 'required',
            'egreso' => 'required',
            'fecha' => 'required',
            'concepto' => 'required',
            'costo' => 'required'
        ]);
        
        Gos_Producto_Ubic_Stock::find($gos_Producto_Ubicacion_id)->update($request->all());
        
        return redirect()->route('ubicacionesstock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto_Ubic_Stock $gos_Producto_Ubic_Stock            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_Producto_Ubicacion_id)
    {
        $ubicacion = Gos_Producto_Ubic_Stock::find($gos_Producto_Ubicacion_id);
        $ubicacion->delete();
        return redirect()->back();
    }
}
