<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Producto_Medida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Producto_Marca;
/**
 *
 * @author yois
 *
 */
class ProductosUnidadMedidaController extends GosControllers
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lista_unidad_medidas = $this->listadoGeneral();
        $ajax = $this->preparaDataTableAjax($lista_unidad_medidas, 'Productos.OpcionesUnidadMedidaDatatable');
        if (null !== $ajax) {
            return $ajax;
        }
        return view('Productos/ListarUnidadMedida', compact('lista_unidad_medidas'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio='')
    {
        // Traer informacion de gos_producto
        return Gos_Producto_Medida::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Productos/EditarUnidadMedida');
    }

    /**
     * Agregar nueva unidad de medida de producto.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomb_medida' => 'required',
            'nomen' => 'required'
        ]);

        $um = new Gos_Producto_Medida([
            'nomb_medida' => $request->get('nomb_medida'),
            'nomen' => $request->get('nomen'),
        ]);
        $um->save();

        return redirect()->route('unidadesMedidas-productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Medida $gos_Producto_Medida
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Producto_Medida $gos_Producto_Medida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Medida $gos_Producto_Medida
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_producto_medida_id)
    {
        $unidadMedida = Gos_Producto_Medida::find($gos_producto_medida_id);
        return view('Productos/EditarUnidadMedida')->with('unidadMedida', $unidadMedida);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gos\Gos_Producto_Medida $gos_Producto_Medida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_producto_medida_id)
    {
        $request->validate([
            'nomb_medida' => 'required',
            'nomen' => 'required'
        ]);
        Gos_Producto_Medida::find($gos_producto_medida_id)
                            ->update($request->all());
        return redirect()->route('unidadesMedidas-productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto_Medida $gos_Producto_Medida
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_producto_medida_id)
    {
        $unidadMedida = Gos_Producto_Medida::find($gos_producto_medida_id);
        $unidadMedida->delete();
        return redirect()->back();
    }
}
