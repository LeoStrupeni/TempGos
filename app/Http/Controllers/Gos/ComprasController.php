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
use App\Gos\Gos_V_Compras_Proveedor;
use App\Gos\Gos_V_Compra_Ver;
use App\Gos\Gos_Compra;
use App\Gos\Gos_Compra_Item;
use App\Gos\Gos_Compra_Administrativa;
use App\Gos\Gos_Compra_Pagos;
use App\Gos\Gos_V_Compra_Pagos;
use App\Gos\Gos_V_Min_Proveedores;
use App\Gos\Gos_Producto;
use App\Gos\Gos_Producto_Externo;
use App\Gos\Gos_Producto_Marca;
use App\Gos\Gos_V_Min_Inventario;
use App\Gos\Gos_V_Inventario_Externo;
use App\Gos\Gos_Forma_Pago;
use App\Gos\Gos_Compra_Tipo;
use App\Gos\Gos_Metodo_Pago;
use App\Http\Controllers\Gos\OS\ItemOSController;
use App\Gos\Gos_Producto_Ubic_Stock;
use App\Gos\Gos_Producto_Medida;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_OS;
use App\Http\Controllers\Gos\ProductosFamiliasController;
use App\Http\Controllers\Gos\ProductosMarcasController;
use App\Http\Controllers\Gos\ProductosUbicacionesController;
use Session;
use Illuminate\Support\Facades\DB;


/**
 *
 * @author yois
 *
 */
class ComprasController extends GosControllers
{

    protected $vistaListado = 'Compras/ListarCompras';

    protected $opcionesEditDataTable = 'Compras.OpcionesComprasDatatable';

    public function index()
    {
        $idtaller=Session::get('taller_id');
        $listaCompras = self::listadoGeneral();
        $ajax = $this->preparaDataTableAjax($listaCompras, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        Gos_V_Compras_Proveedor::where(self::condIdTaller())->get();
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        // $cuentaAdeudo = Gos_Compra::where(self::condIdTaller())->whereNull('fecha_pago')->count();
        $cuentaTodos = Gos_Compra::where(self::condIdTaller())->count();
        $cuentaAdeudo = DB::select( DB::raw("SELECT count(*) AS cuenta  FROM   gos_v_compras_proveedor gvcp
        LEFT JOIN gos_compra gc ON gc.gos_compra_id = gvcp.gos_compra_id
        LEFT JOIN gos_v_compras_pagos gvcpa ON gc.gos_compra_id = gvcpa.gos_compra_id
        WHERE  gc.gos_taller_id=".$idtaller." AND (gvcpa.UltimoPago = 0 OR gvcpa.UltimoPago IS NULL)"));
        $cuentaAdeudo=$cuentaAdeudo[0]->cuenta;
        $activeTodo=('active');
        return view($this->getVistaListado(),compact('listaMetodosPagos','cuentaAdeudo','cuentaTodos','activeTodo'));
    }
   
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Compras_Proveedor::where(self::condIdTaller())->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compact = $this->preparaCrearEditar();
        return view('Compras/NuevaCompra', $compact);
    }

    protected function preparaCrearEditar()
    {
        $idtaller=Session::get('taller_id');
        $listaProveedores = $this->listaProveedores();
        $listaProductos = Producto::listaProductos();
        $listaInvExterno = Gos_V_Inventario_Externo::where('gos_taller_id',$idtaller)->get();
        $listaFormasPagos = Gos_Forma_Pago::all();
        $listaTiposCompra = Gos_Compra_Tipo::all();
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        //
        $listaMedidas = Gos_Producto_Medida::all();
        $listaMarcas = ProductosMarcasController::listadoGeneral();
        $listaFamilias = ProductosFamiliasController::listadoGeneral();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        
        $listadoOSProceso = DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario OS
        WHERE OS.gos_taller_id='.$idtaller.' AND OS.fecha_terminado IS NULL
        GROUP BY OS.gos_os_id
        ORDER BY OS.nro_orden_interno ASC'));

        return compact('listaProveedores', 'listaProductos','listaInvExterno','listaFormasPagos','listaTiposCompra','listaMetodosPagos','listaMedidas', 'listaMarcas', 'listaFamilias','listaUbicaciones','listadoOSProceso');
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

    protected function guardaJson(Request $request, $id = 0)
    {
        $compra = $this->preparaDatos($request);
        
        if (isset($request->cantidad)){
            $this->guardaItemCompra($request);
        }

        return Response::json($compra);
    }

    protected function preparaDatos(Request $request)
    {        
        $compra = null;
        $gos_compra_id = isset($request->gos_compra_id) ? $request->gos_compra_id : 0;
        $datos = $this->datosEntidad($request);
        if ($gos_compra_id !== 0) {
            $compra = Gos_Compra::find($gos_compra_id)->update($datos);
        } else {
            $compra = new Gos_Compra($datos);
            $compra->save();
            $gos_compra_id = $compra->gos_compra_id;
        }
        $this->setEntidad_id($gos_compra_id);
        
        return $gos_compra_id;
    }

    protected function datosEntidad($request)
    {       
        $fecha_compra = $this->convierteFechaHaciaMySQLFormat($request->fecha_compra);
        $fecha_pago = isset($request->fecha_pago) ? $this->convierteFechaHaciaMySQLFormat($request->fecha_pago) : null;
        
        $descuento = isset($request->descuento) ? $request->descuento : 0;
        $iva = isset($request->iva) ? $request->iva : 0;
        
        $datos = [
            'gos_taller_id' => self::tallerIdActual(),
            'nro_factura' => $request->nro_factura,
            'gos_compra_tipo_id' => $request->gos_compra_tipo_id,
            'gos_proveedor_id' => $request->gos_proveedor_id,
            'gos_forma_pago_id' => $request->gos_forma_pago_id,
            'gos_metodo_pago_id' => $request->gos_metodo_pago_id, 
            'fecha_compra' => $fecha_compra,
            'fecha_pago' => $fecha_pago,
            'descuento_tipo' => $request->descuento_tipo,          
            'descuento' => $descuento,
            'iva' => $iva,
        ];
        return $datos;
    }

    protected function guardaItemCompra($request)
    {   
        $producto_id = $request->gos_producto_id;

        if($producto_id == 'CP'){
            $marca = new Gos_Producto_Marca([
                'nomb_marca' => $request->nomb_marca,
                'gos_taller_id' => Session::get('taller_id')
            ]);
            $marca->save();
            $producto_marca_id = $marca->gos_producto_marca_id;

            $datos = [
                'gos_taller_id' => Session::get('taller_id'),
                'gos_proveedor_id' => $request->gos_proveedor_id,
                'codigo' => 'compra unica',
                'nomb_producto' => 'compra unica',
                'descripcion' => $request->descripcion,
                'gos_producto_medida_id' => $request->gos_producto_medida_id,
                'gos_producto_marca_id' => $producto_marca_id,
                'gos_producto_familia_id' => 0,
                'venta' => $request->venta,
                'cant_minima' => 0
            ];
            $producto = new Gos_Producto($datos);
            $producto->save();
            $producto_id = $producto->gos_producto_id;
        }
                
        $gos_compra_id = $this->getEntidad_id();
        $descuento = isset($request->descuento) ? $request->descuento : 0;
        $iva = isset($request->iva) ? $request->iva : 0;
        
        $item = null;

        if($request->gos_compra_tipo_id == 1){
            $datos = [
                'gos_compra_id' => $gos_compra_id,
                'descripcion' => $request->descripcion,
                'costo' => $request->costo
            ];
            $item = new Gos_Compra_Administrativa($datos);
            $item->save();
        } else if($request->gos_compra_tipo_id == 3){
            $datos = [
                'gos_compra_id' => $gos_compra_id,
                'gos_producto_id' => $request->gos_producto_id_ext,
                'cantidad' => $request->cantidad,
                'tipoProducto' => 'Externo',
                'costo' => $request->costo,
                'iva' => $iva,
                'precio_venta' => $request->venta,
                'descuento' => $descuento
            ];
            $item = new Gos_Compra_Item($datos);
            $item->save();

            $codigo = Gos_Producto_Externo::where('gos_producto_id',$request->gos_producto_id_ext)->first();
            $cantidad = $codigo['Cantidad'] + $request->cantidad;

            Gos_Producto_Externo::find($request->gos_producto_id_ext)->update([
                'gos_proveedor_id' => $request->gos_proveedor_id,
                'venta' => $request->venta,
                'Costo' => $request->costo,
                'Cantidad' => $cantidad
            ]);
        }else{
            $datos = [
                'gos_compra_id' => $gos_compra_id,
                'gos_producto_id' => $producto_id,
                'tipoProducto' => 'Interno',
                'cantidad' => $request->cantidad,
                'costo' => $request->costo,
                'iva' => $iva,
                'precio_venta' => $request->venta,
                'descuento' => $descuento
            ];
            $item = new Gos_Compra_Item($datos);
            $item->save();

            Gos_Producto::find($producto_id)->update(['gos_proveedor_id' => $request->gos_proveedor_id,
                'venta' => $request->venta]);

            $fechaStock = $this->convierteFechaHaciaMySQLFormat($request->fecha_compra);
            $stock = [
                'gos_producto_id' => $producto_id,
                'gos_producto_ubicacion_id' => 0,
                'ingreso' => $request->cantidad,
                'fecha' => $fechaStock,
                'costo' => $request->costo,
                'ingreso' => $request->cantidad,
            ];
    
            $this->guardarstock($stock);
        }
        
        return Response::json($item);
    }


    protected function guardarStock($stock)
    {
        $ubicacionStock = null;
        $ubicacion = Gos_Producto_Ubic_Stock::where('gos_producto_id',$stock['gos_producto_id'])->first();

        if (isset($ubicacion['gos_producto_ubic_stock_id'])) {
            $cantidad = $ubicacion['ingreso'] + $stock['ingreso'];
            $ubicacionStock = Gos_Producto_Ubic_Stock::find($ubicacion['gos_producto_ubic_stock_id'])->update([
                'ingreso' => $cantidad,
                'costo' => $stock['costo'],
                'fecha' => $stock['fecha']
            ]);
        } else {
            $ubicacionStock = new Gos_Producto_Ubic_Stock($stock);
            $ubicacionStock->save();
        }
        
        return $ubicacionStock;
    }

    /** PAGOS DE COMPRAS */
    public function pagoCompra(Request $request)
    {         
        //Actualizacion metodo pago compra
        Gos_Compra::find($request->gos_compra_id)->update(['gos_metodo_pago_id' => $request->metodoPago]);

        $fecha = $this->convierteFechaHaciaMySQLFormat($request->fecha);
        $datos = [
            'gos_compra_id' => $request->gos_compra_id,
            'importe' => $request->importe,
            'fecha' => $fecha,
            'numero_documento' => $request->numero_documento
        ];

        $item = new Gos_Compra_Pagos($datos);
        $item->save();

        return Response::json($item);
    }

    public function listaPagoPorCompra($gos_compra_id)
    {
        $pagos = Gos_V_Compra_Pagos::find($gos_compra_id);
        return Response::json($pagos);
    }

    public function listaPagos()
    {
        $pagos = Gos_Compra_Pagos::select('gos_compra_pagos.gos_compra_pagos_id','gos_compra_pagos.gos_compra_id','gos_compra_pagos.importe','gos_compra_pagos.fecha','gos_taller_id')
                                    ->join('gos_compra', 'gos_compra_id', '=', 'gos_compra_id')
                                    ->where(self::condIdTaller())
                                    ->get();
        return Response::json($pagos);
    }

    public function RegistroPagosCompra($gos_compra_id)
    {
        $pagos = Gos_Compra_Pagos::where('gos_compra_id',$gos_compra_id)->get();
        $ajax = $this->preparaDataTableAjax($pagos, '');
        return $ajax;
                
    }

    public function pagoCompraContado(Request $request)
    {         
        $totalCompra = Gos_V_Compra_Pagos::select('TotalCompra','TotalPagado')->where('gos_compra_id',$request->gos_compra_id)->get();
        $importe = null;
        $pagado = null;
        foreach ($totalCompra as $compra) {
            $importe = $compra->TotalCompra;
            $pagado = $compra->TotalPagado;
            }

        if($pagado==0){
            $fecha = $this->convierteFechaHaciaMySQLFormat($request->fecha_compra);

            $datos = [
                'gos_compra_id' => $request->gos_compra_id,
                'importe' => $importe,
                'fecha' => $fecha
            ];
            $item = new Gos_Compra_Pagos($datos);
            $item->save();
            return Response::json($item);
        } else {
            return 0;
        }
        
    }

    public function unirCompra(Request $request){
        $gos_os_id = $request->gos_os_id;
        $gos_compra_id = $request->gos_compra_id;
        $productos = $request->productos;

        Gos_Compra::find($gos_compra_id)->update(['gos_os_id' => $gos_os_id]);
        
        foreach ($productos as $item) {
            $gos_producto_id = $item[0];
            $cantidad = $item[1];

            $detalleprod = Gos_Compra_Item::where('gos_compra_id',$gos_compra_id)->where('gos_producto_id',$gos_producto_id)->first();
            $existProducto = Gos_Producto_Ubic_Stock::where('gos_producto_id',$gos_producto_id)->first();
            $osProducto = Gos_Os_Item::where('gos_producto_id', $gos_producto_id)->where('gos_os_id',$gos_os_id)->first();

            if(isset($osProducto)){
                $sumaCantidad = $osProducto->cantidad + $cantidad;
                Gos_Os_Item::where('gos_producto_id', $gos_producto_id)
                            ->where('gos_os_id',$gos_os_id)
                            ->update(['cantidad' => $sumaCantidad,'precio_materiales' => $detalleprod['precio_venta']]);
    
                $restante = $existProducto->ingreso - $cantidad;
                $existProducto->ingreso =  $restante;
                $existProducto->save();
    
                $os = Gos_OS::find($gos_os_id);
                $subtotalOs = $os->subtotal;
                $producto = $detalleprod['precio_venta']*$cantidad;
                $subtotalProducto = $producto-$detalleprod['descuento'];
                $subT = $subtotalOs+$subtotalProducto;
                $subtotal = Gos_OS::where('gos_os_id',$gos_os_id)->update(['subtotal' => $subT]);
            }
            else{
                $prodEnOs = new Gos_Os_Item([
                    'gos_producto_id'=> $gos_producto_id,
                    'gos_os_id'=> $gos_os_id,
                    'precio_materiales' => $detalleprod['precio_venta'],
                    'codigo_sat'=> null,
                    'descuento' => $detalleprod['descuento'],
                    'cantidad' => $cantidad
                ]);
                $prodEnOs->save();
    
                $restante = $existProducto->ingreso - $cantidad;
                $existProducto->ingreso = $restante;
                $existProducto->save();

                $os = Gos_OS::find($gos_os_id);
                $subtotalOs = $os->subtotal;
                $producto = $detalleprod['precio_venta']*$cantidad;
                $subtotalProducto = $producto-$detalleprod['descuento'];
                $subT = $subtotalOs+$subtotalProducto;
                $subtotal = Gos_OS::where('gos_os_id',$gos_os_id)->update(['subtotal' => $subT]);
            }
        }

        return $gos_os_id;
        
    }


    /**
     * funcion publica que devuelve lista en formto json de Proveedores
     *
     * @return unknown
     */
    public function refrescaProveedores()
    {
        return Response::json($this->listaProveedores());
    }
    public function refrescaProductos()
    {
        return Response::json($this->listaProductos());
    }
    protected function listaProveedores()
    {
        return ProveedoresController::listaMiniProveedors();
    }

    protected function listaProductos()
    {
        return ProductosController::listaMinProductos();
    }

    protected function listaMinProductos()
    {
    return Gos_V_Min_Inventario::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_compra_id)
    {
        $compra = Gos_V_Compra_Ver::find($gos_compra_id);
        return Response::json($compra);
        
    }

    public function edit($gos_compra_id)
    {
        $compra = Gos_Compra::find($gos_compra_id);
        $nroInterno = Gos_OS::select('nro_orden_interno')->where('gos_os_id',$compra->gos_os_id)->first();
        
        $idtaller=Session::get('taller_id');
        $listaProveedores = $this->listaProveedores();
        $listaProductos = Producto::listaProductos();
        $listaInvExterno = Gos_V_Inventario_Externo::where('gos_taller_id',$idtaller)->get();
        $listaFormasPagos = Gos_Forma_Pago::all();
        $listaTiposCompra = Gos_Compra_Tipo::all();
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        //
        $listaMedidas = Gos_Producto_Medida::all();
        $listaMarcas = ProductosMarcasController::listadoGeneral();
        $listaFamilias = ProductosFamiliasController::listadoGeneral();
        $listaUbicaciones = ProductosUbicacionesController::listadoGeneral();
        
        $listadoOSProceso = DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario OS
        WHERE OS.gos_taller_id='.$idtaller.' AND OS.fecha_terminado IS NULL
        GROUP BY OS.gos_os_id
        ORDER BY OS.nro_orden_interno ASC'));

        $compact = compact('compra','listaProveedores','listaInvExterno', 'listaProductos','listaFormasPagos','listaTiposCompra','listaMetodosPagos','listaMedidas', 'listaMarcas', 'listaFamilias','listaUbicaciones','listadoOSProceso','nroInterno');
        return view('Compras/NuevaCompra', $compact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // return $this->guardaJson($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_compra_id)
    {
        $compra = Gos_Compra::find($gos_compra_id);
        $compra->delete();
        return Response::json($compra);
    }

    public function GetCompraAdeudo(){
        $idtaller=Session::get('taller_id');
        // return('dddd');Gos_V_Compras_Proveedor
        $listaComprasadeudo = DB::select( DB::raw("SELECT *  FROM  gos_v_compras_proveedor gvcp
        LEFT JOIN gos_compra gc ON gc.gos_compra_id = gvcp.gos_compra_id
        LEFT JOIN (SELECT UltimoPago , gos_compra_id as idcompra FROM gos_v_compras_pagos) gvcpa ON gc.gos_compra_id = gvcpa.idcompra
        WHERE  gc.gos_taller_id=".$idtaller." AND (gvcpa.UltimoPago = 0 OR gvcpa.UltimoPago IS NULL)"));
        // return(count($listaCompras));
         
        $cuentaAdeudo = DB::select( DB::raw("SELECT count(*) AS cuenta  FROM   gos_v_compras_proveedor gvcp
        LEFT JOIN gos_compra gc ON gc.gos_compra_id = gvcp.gos_compra_id
        LEFT JOIN gos_v_compras_pagos gvcpa ON gc.gos_compra_id = gvcpa.gos_compra_id
        WHERE  gc.gos_taller_id=".$idtaller." AND (gvcpa.UltimoPago = 0 OR gvcpa.UltimoPago IS NULL)"));

        $cuentaAdeudo=$cuentaAdeudo[0]->cuenta;
        $cuentaTodos = Gos_Compra::where(self::condIdTaller())->count();
        // $listaCompras = Gos_V_Compras_Proveedor::where(self::condIdTaller())->get();
        $ajax = $this->preparaDataTableAjax($listaComprasadeudo, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        $activeAdeu=('active');

        return view($this->getVistaListado(),compact('listaMetodosPagos','cuentaAdeudo','cuentaTodos','activeAdeu'));
    }
   
    
}
