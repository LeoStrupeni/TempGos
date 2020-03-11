<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Producto;
use App\Gos\Gos_Producto_Medida;
use App\Gos\Gos_V_Inventario_Interno;
use App\Gos\Gos_V_Min_Inventario;
use App\Gos\Gos_Producto_Ubic_Stock;

use App\Http\Controllers\Gos\ProveedoresController;
use App\Http\Controllers\Gos\ProductosFamiliasController;
use App\Http\Controllers\Gos\ProductosMarcasController;
use App\Http\Controllers\Gos\ProductosUbicacionesController;
use App\Gos\Gos_Taller_Conf_vehiculo;
use Session;

// use Yajra\DataTables\EloquentDataTable;

/**
 *
 * @author yois
 *        
 */
class ProductosController extends GosControllers
{

    protected $vistaListado = 'Productos/ListarProducto';

    protected $opcionesEditDataTable = 'Productos.OpcionesProductoDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaProductos = self::listadoGeneral();
        $usuario_id = Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
        $compact = array_merge($this->preparaCrearEditar(), compact('listaProductos','taller_conf_vehiculo'));
        
        $ajax = $this->preparaDataTableAjax($listaProductos, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), $compact);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        $idtaller=Session::get('taller_id');
        return Gos_V_Inventario_Interno::where('gos_taller_id', $idtaller)->get();
        //->where('codigo','<>','compra unica')
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $listaMedidas = Gos_Producto_Medida::all();
        $listaMarcas = ProductosMarcasController::listadoGeneral();
        $listaFamilias = ProductosFamiliasController::listadoGeneral();
        $listaProveedores = ProveedoresController::listadoGeneral();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        //
        return compact('listaMedidas', 'listaMarcas', 'listaFamilias', 'listaProveedores', 'listaUbicaciones');
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
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $producto = $this->preparaDatos($request);
        return Response::json($producto);
    }

    /**
     *
     * @param
     *            request
     */
    protected function preparaDatos($request)
    {
        
        $producto = null;
        $gos_producto_id = isset($request->gos_producto_id) ? $request->gos_producto_id : 0;
        
        $codigo = Gos_Producto::where('codigo',$request->codigo)->first();

        $datos = $this->datosEntidad($request);
        
        if ($gos_producto_id > 0) {          
            $producto = Gos_Producto::find($gos_producto_id)->update($datos);
        } else if(isset($codigo)) {
            $gos_producto_id = $codigo['gos_producto_id'];
        } else {
            $producto = new Gos_Producto($datos);
            $producto->save();
            $gos_producto_id = $producto->gos_producto_id;
        }
        $this->setEntidad_id($gos_producto_id);
        $this->guardarDatosRelacionados($request);
        return $gos_producto_id;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]|unknown[]
     */
    protected function datosEntidad($request)
    {
        $datos = [
            'gos_taller_id' => self::tallerIdActual(),
            'gos_proveedor_id' => $request->gos_proveedor_id,
            'codigo' => $request->codigo,
            'nomb_producto' => $request->nomb_producto,
            'descripcion' => $request->descripcion,
            'gos_producto_medida_id' => $request->gos_producto_medida_id,
            'gos_producto_marca_id' => $request->gos_producto_marca_id,
            'gos_producto_familia_id' => $request->gos_producto_familia_id,
            'codigo_sat' => $request->codigo_sat,
            'ganancia' => $request->gananciaok,
            'venta' => $request->venta,
            'cant_minima' => $request->cant_minima
        ];
        return $datos;
    }

    protected function guardarDatosRelacionados($request)
    {
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
        
        $ubicacion = null;
        $ubicacion = isset($request->gos_producto_ubicacion_id) ? $request->gos_producto_ubicacion_id : 0;
        
        $datosRelacionados = [
            'gos_producto_id' => $this->getEntidad_id(),
            'gos_producto_ubicacion_id' => $ubicacion,
            'ingreso' => $request->cantidad,
            'fecha' => $fecha,
            'costo' => $request->costo
        ];
        
        $ubicacionStock = null;
        $gos_producto_ubic_stock_id = isset($request->gos_producto_ubic_stock_id) ? $request->gos_producto_ubic_stock_id : 0;
        $codigoUbi = Gos_Producto_Ubic_Stock::where('gos_producto_id',$this->getEntidad_id())->first();
        
        if ($gos_producto_ubic_stock_id > 0) {
            $ubicacionStock = Gos_Producto_Ubic_Stock::find($gos_producto_ubic_stock_id)->update($datosRelacionados);
        } else if(isset($codigoUbi)){
            $cantidad = $codigoUbi['ingreso'] + $request->cantidad;
            $ubicacionStock = Gos_Producto_Ubic_Stock::find($codigoUbi['gos_producto_ubic_stock_id'])->update([
                'ingreso' => $cantidad,
                'fecha' => $fecha
            ]);
        } else {
            $ubicacionStock = new Gos_Producto_Ubic_Stock($datosRelacionados);
            $ubicacionStock->save();
        }
        
        return $ubicacionStock;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto $gos_Producto            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_producto_id)
    {
        // FUNCION USADA EN ITEMS DE OS E ITEMS COMPRAS
        return Response::json(Gos_V_Inventario_Interno::find($gos_producto_id));
    }

    /**
     * Mostrar formulario de edcicion de Productos con sus recuros
     *
     * @param Gos_Producto $gos_producto            
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    /**
     *
     * @param Integer $gos_producto_id            
     */
    public function edit($gos_producto_id)
    {
        $this->setEntidad_id($gos_producto_id);
        $producto = Gos_V_Inventario_Interno::find($gos_producto_id);
        
        return Response::json($producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Producto $gos_Producto            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_producto_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto $gos_Producto            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_producto_id)
    {
        $producto = Gos_Producto::find($gos_producto_id);
        $producto->delete();
        return Response::json($producto);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaMinProductos()
    {
        return Gos_V_Min_Inventario::all();
    }

    public function ultimaCompra($gos_producto_id){
        $idtaller=Session::get('taller_id');
        $ultimaCompra = DB::select(DB::raw(
            "SELECT gos_taller_id,nomb_proveedor,substring(Fechas,1,10) AS fecha,C.total,C.gos_compra_id
            FROM gos_v_compras_proveedor C 
            INNER JOIN (SELECT gos_producto_id,tipoProducto,max(gos_compra_id) as gos_compra_id
                        FROM gos_compra_item 
                        WHERE tipoProducto = 'Interno'
                        AND gos_producto_id = '".$gos_producto_id."'
                        GROUP BY gos_producto_id,tipoProducto) T
            ON C.gos_compra_id = T.gos_compra_id
            "
        ));
        return Response::json($ultimaCompra);
    }

    public function itemsUltimaCompra($gos_compra_id){
        $idtaller=Session::get('taller_id');
        $itemsultimaCompra = DB::select(DB::raw(
            "SELECT C.*,E.cantidad as CantDisponible
            FROM gos_v_compras_items C 
            INNER JOIN (SELECT gos_producto_id,sum(ingreso) AS cantidad 
                        FROM gos_producto_ubic_stock GROUP BY gos_producto_id) E 
            ON C.gos_producto_id = E.gos_producto_id
            WHERE gos_compra_id = ".$gos_compra_id
        ));
        return Response::json($itemsultimaCompra);
    }

    public function listaOsVendidos($gos_producto_id){
        $idtaller=Session::get('taller_id');
        
        $listaOs = DB::select(DB::raw(
            "SELECT I.*, C.*
            FROM gos_v_os_producto_interno_externo I
            INNER JOIN (SELECT distinct gos_taller_id,gos_os_id, nro_orden_interno,detallesVehiculo,
                        nomb_aseguradora_min,nomb_cliente,fecha_entregado,fecha_terminado,porcentaje,
                        CAST(fecha_creacion_os as DATE) as fecha_creacion_os,CAST(fecha_ingreso_v_os as DATE) as fecha_ingreso_v_os
                        FROM gos_v_inicio_calendario) C 
            ON I.gos_os_id = C.gos_os_id
            WHERE C.gos_taller_id = '".$idtaller."'
            AND I.gos_producto_id = '".$gos_producto_id."'"
        ));

        return Response::json($listaOs);
    }


}
