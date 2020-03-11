<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Yajra\DataTables\EloquentDataTable;
use App\Gos\Gos_Taller_Conf_vehiculo;
use Session;

use App\Gos\Gos_Producto_Marca;

/**
 *
 * @author yois
 *        
 */
class ProductosMarcasController extends GosControllers
{
    protected $vistaListado = 'Productos/ListarMarca';

    protected $opcionesEditDataTable = 'Productos.OpcionesProductoMarcaDatatable';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMarcas = $this->listadoGeneral();
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $ajax = $this->preparaDataTableAjax($listaMarcas, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), compact('listaMarcas','taller_conf_vehiculo'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_Producto_Marca::where('gos_taller_id',Session::get('taller_id'))->get();
        
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
     * Agregar nueva marca de producto.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nomb_marca' => 'required'
        // ]);
        return $this->guardaJson($request);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::guardaJson()
     */
    protected function guardaJson(Request $request, $id = 0)
    {
        $marca = $this->preparaDatos($request);
        return Response::json($marca);
    }

    /**
     *
     * @param
     *            request
     */
    protected function preparaDatos($request)
    {
        $marca = null;
        $gos_producto_marca_id = isset($request->gos_producto_marca_id) ? $request->gos_producto_marca_id : 0;
        $datos = $this->datosEntidad($request);
        if ($gos_producto_marca_id > 0) {
            $marca = Gos_Producto_Marca::find($gos_producto_marca_id)->update($datos);
        } else {
            $marca = new Gos_Producto_Marca($datos);
            $marca->save();
            $gos_producto_marca_id = $marca->gos_producto_marca_id;
        }

        $this->setEntidad_id($gos_producto_marca_id);

        return $marca;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        return [
            'nomb_marca' => $request->nomb_marca,
            'gos_taller_id' => Session::get('taller_id')
        ];
    }

    /**
     * Agregar nueva marca de producto.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Marca $gos_Producto_Marca            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Producto_Marca $gos_Producto_Marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Marca $gos_Producto_Marca            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_producto_marca_id)
    {
        $this->setEntidad_id($gos_producto_marca_id);
        $marca = Gos_Producto_Marca::find($gos_producto_marca_id);
        
        return Response::json($marca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Producto_Marca $gos_Producto_Marca            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_producto_marca_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto_Marca $gos_Producto_Marca            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_producto_marca_id)
    {
        $marca = Gos_Producto_Marca::find($gos_producto_marca_id);
        $marca->delete();
        return Response::json($marca);
        
    }

    public static function cargaRapida(Request $request)
    {
        $marca = new Gos_Producto_Marca([
            'gos_taller_id' => Session::get('taller_id'),
            'nomb_marca' => $request->name,
        ]);
        
        $marca->save();
        $gos_producto_marca_id = $marca->gos_producto_marca_id;  
        return $gos_producto_marca_id;
    }
    
}
