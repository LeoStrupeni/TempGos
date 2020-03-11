<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Producto_Externo;
use App\Gos\Gos_V_Inventario_Externo;
use App\Gos\Gos_Producto_Medida;
use App\Gos\Gos_V_Usuarios;
use App\Gos\Gos_Producto_Externo_Entregados;

use App\Http\Controllers\Gos\ProveedoresController;
use App\Http\Controllers\Gos\ProductosFamiliasController;
use App\Http\Controllers\Gos\ProductosMarcasController;
use App\Http\Controllers\Gos\ProductosUbicacionesController;
use App\Gos\Gos_Taller_Conf_vehiculo;
use Session;


class InventarioExternoController extends GosControllers
{

    protected $vistaListado = 'InventarioExterno/ListarInventarioExterno';

    protected $opcionesEditDataTable = 'InventarioExterno.OpcionesDatatable';

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
        return Gos_V_Inventario_Externo::where(self::condIdTaller());
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
        $listaTecnicos = Gos_V_Usuarios::select('gos_usuario_id','nombre_apellidos')->where(self::condIdTaller())->where('gos_usuario_rol_id',2)->get();
        $listaUsuarios = Gos_V_Usuarios::select('gos_usuario_id','nombre_apellidos','nomb_rol')->where(self::condIdTaller())->get();
        //
        return compact('listaMedidas', 'listaMarcas', 'listaFamilias', 'listaProveedores', 'listaUbicaciones','listaTecnicos','listaUsuarios');
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
        
        if ($gos_producto_id > 0) {
            $cantidadProd = Gos_Producto_Externo::select('Cantidad')
                                                    ->where('gos_producto_id',$gos_producto_id)
                                                    ->first();

            $cantidad = $cantidadProd['Cantidad'] + $request->cantidad;
            $producto = Gos_Producto_Externo::find($gos_producto_id)
                        ->update([
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
                            'cant_minima' => $request->cant_minima,
                            'Costo' => $request->costo,
                            'Cantidad' => $cantidad,
                            'Ubicacion'=> $request->ubicacion
                        ]);           
        } else {
            $producto = new Gos_Producto_Externo([
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
                'cant_minima' => $request->cant_minima,
                'Costo' => $request->costo,
                'Cantidad' => $request->cantidad,
                'Ubicacion'=> $request->ubicacion
            ]);
            $producto->save();
            $gos_producto_id = $producto->gos_producto_id;
        }
        
        $this->setEntidad_id($gos_producto_id);
        return $gos_producto_id;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Externo $gos_Producto            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_producto_id)
    {
        // FUNCION USADA EN ITEMS DE OS E ITEMS COMPRAS
        return Response::json(Gos_V_Inventario_Externo::find($gos_producto_id));
    }

    /**
     * Mostrar formulario de edcicion de Productos con sus recuros
     *
     * @param Gos_Producto_Externo $gos_producto            
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    /**
     *
     * @param Integer $gos_producto_id            
     */
    public function edit($gos_producto_id)
    {
        $this->setEntidad_id($gos_producto_id);
        $producto = Gos_V_Inventario_Externo::find($gos_producto_id);
        
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
        $producto = Gos_Producto_Externo::find($gos_producto_id);
        $producto->delete();
        return Response::json($producto);
    }

    public function ultimaCompra($gos_producto_id){
        $idtaller=Session::get('taller_id');
        $ultimaCompra = DB::select(DB::raw(
            "SELECT gos_taller_id,nomb_proveedor,substring(Fechas,1,10) AS fecha,C.total,C.gos_compra_id
            FROM gos_v_compras_proveedor C 
            INNER JOIN (SELECT gos_producto_id,tipoProducto,max(gos_compra_id) as gos_compra_id
                        FROM gos_compra_item 
                        WHERE tipoProducto = 'Externo'
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
            "SELECT C.*,E.Cantidad as CantDisponible
            FROM gos_v_compras_items C 
            INNER JOIN gos_producto_externo E 
            ON C.gos_producto_id = E.gos_producto_id
            WHERE gos_compra_id = ".$gos_compra_id
        ));
        return Response::json($itemsultimaCompra);
    }

    public function listaCantidadTecnicos($gos_producto_id){
        $idtaller=Session::get('taller_id');
        
        $listaTecnicosCantidades = DB::select(DB::raw(
            "SELECT I.gos_producto_id,I.cantidad,CONCAT(U.nombre,' ',U.apellidos) as nombre,I.costo,(I.costo * I.cantidad) as Total,
                    C.gos_taller_id,C.gos_os_id,C.nro_orden_interno,C.detallesVehiculo,C.nomb_aseguradora_min,C.nomb_cliente,C.fecha_entregado,
                    C.fecha_terminado,C.porcentaje,C.fecha_creacion_os,C.fecha_ingreso_v_os
            FROM gos_os_producto_externo I
                INNER JOIN (SELECT distinct gos_taller_id,gos_os_id, nro_orden_interno,detallesVehiculo,nomb_aseguradora_min,nomb_cliente,
                            fecha_entregado,fecha_terminado,porcentaje,CAST(fecha_creacion_os as DATE) as fecha_creacion_os,
                            CAST(fecha_ingreso_v_os as DATE) as fecha_ingreso_v_os
                FROM gos_v_inicio_calendario) C 
                ON I.gos_os_id = C.gos_os_id
                INNER JOIN gos_usuario U ON I.gos_usuario_id = U.gos_usuario_id
            WHERE C.gos_taller_id = '".$idtaller."' AND I.gos_producto_id = '".$gos_producto_id."'
            UNION ALL
            SELECT E.gos_producto_id,SUM(E.cantidad) as cantidad, 
                    CONCAT(U.nombre,' ',U.apellidos) as nombre,
                    EX.Costo as costo_unidad,(EX.Costo * SUM(E.cantidad)) as Total,E.gos_taller_id,'','','','','','','','','',''
            FROM gos_producto_externo_entregados E 
                LEFT JOIN gos_usuario U ON E.gos_usuario_id_recibido = U.gos_usuario_id
                LEFT JOIN gos_usuario_perfil P ON U.gos_usuario_perfil_id = P.gos_usuario_perfil_id
                LEFT JOIN gos_producto_externo EX ON E.gos_producto_id = EX.gos_producto_id
            WHERE E.gos_taller_id = '".$idtaller."'
            AND E.gos_producto_id = '".$gos_producto_id."'
            GROUP BY E.gos_producto_id,CONCAT(U.nombre,' ',U.apellidos,IF(P.gos_usuario_rol_id = 2,' (Tecnico)',' (Administrativo)')),EX.Costo"
        ));

        // ,IF(P.gos_usuario_rol_id = 2,' (Tecnico)',' (Administrativo)')
        return Response::json($listaTecnicosCantidades);
    }

    public function entregarProductoExterno(Request $request){
        $idtaller=Session::get('taller_id');
        $gos_usuario_id_carga = Session::get('usr_Data')->gos_usuario_id;

        $producto = new Gos_Producto_Externo_Entregados([
            'gos_usuario_id_carga' => $gos_usuario_id_carga,
            'gos_usuario_id_recibido' => $request->gos_usuario_id,
            'gos_producto_id' => $request->gos_producto_id,
            'cantidad' => $request->cantidad,
            'gos_taller_id' => $idtaller
        ]);
        $producto->save();

        $producto = Gos_Producto_Externo::find($request->gos_producto_id);
        $cantidad = $producto['Cantidad'] - $request->cantidad;
        $updateProducto = Gos_Producto_Externo::where('gos_producto_id',$request->gos_producto_id)
                                                ->update(['Cantidad' => $cantidad]);

        return $request->gos_producto_id;
    }
    
    public function listaEntregas($gos_producto_id){
        $idtaller=Session::get('taller_id');
        $lista_producto_externo_entregados = DB::select(DB::raw(
            "SELECT gos_taller_id,
                    CONCAT(U.nombre,' ',U.apellidos) as nombre,
                    gos_producto_id,
                    SUM(PE.cantidad) as cantidad
            FROM gos_producto_externo_entregados PE 
            LEFT JOIN gos_usuario U on PE.gos_usuario_id_recibido = U.gos_usuario_id
            WHERE PE.gos_taller_id = '".$idtaller."'
            AND PE.gos_producto_id = '".$gos_producto_id."'
            GROUP BY gos_taller_id,CONCAT(U.nombre,' ',U.apellidos),gos_producto_id
            "
        ));

        $ajax = $this->preparaDataTableAjax($lista_producto_externo_entregados, '');
        return $ajax;
    }
    
}