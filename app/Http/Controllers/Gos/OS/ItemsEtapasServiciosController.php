<?php
namespace App\Http\Controllers\Gos\OS;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use \Response;
use App\Http\Controllers\Gos\OS\ItemsController;
use App\Http\Controllers\Gos\GosControllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gos\GosSistemaParametrosController;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_V_Items_Paquetes;
use App\Gos\Gos_V_Os_Items;

/**
 * Clase Controller de Items de OS
 *
 * @author yois
 *        
 */
class ItemsEtapasServiciosController extends ItemsController
{

    protected $opcionesEditDataTable = 'OS.Items.OpcionesItemsDatatable';

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
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // inicializar variables
        $datos = array();
        $tipoItemElegido = $request->item_tipo;
        $gos_os_id = 0;
        // Dependiendo del tipo de item elegido
        switch ($tipoItemElegido) {
            case 'Etapa':
                $datos = $this->datosItemEtapas($request);
                break;
            case 'Producto':
                $datos = $this->datosItemProducto($request);
                break;
            default:
                $gos_os_id = $this->guardaDatosPaquete($request);
                break;
        }
        // si hay datos
        if (count($datos) > 0) {
            $gos_os_id = $datos['gos_os_id'];
            // agregar item a la os
            $item = new Gos_Os_Item($datos);
            $item->save();
        }
        return $this->obtenListaItems($gos_os_id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::datosEntidad()
     */
    protected function datosEntidad($request)
    {
        $datosEntidad = parent::datosEntidad($request);
        $datosEntidad['gos_os_id'] = $this->getGos_os_id();
        //
        return $datosEntidad;
    }

    /**
     *
     * @param unknown $request            
     * @return \Http\Controllers\Gos\OS\number[]|\Http\Controllers\Gos\OS\NULL[]
     */
    protected function datosItemEtapas($request)
    {
        /**
         * id os
         *
         * @var unknown $gos_os_id
         */
        $gos_os_id = $request->gos_os_id_EtapaItem;
        $this->setGos_os_id($gos_os_id);
        
        return parent::datosItemEtapas($request);
    }

    /**
     *
     * @return number
     */
    protected function preparaDescuento()
    {
        $descuento = isset($request->p_descuento) ? floatval($request->p_descuento) : floatval(0);
        return $descuento;
    }

    /**
     *
     *
     * /**
     *
     * @param unknown $request            
     * @return string[]|NULL[]
     */
    protected function datosItemProducto($request)
    {
        /**
         *
         * @var unknown $gos_os_id
         */
        $gos_os_id = $request->gos_os_id_ProductoItem;
        $tipo_item = $this->tipoItemOSProducto();
        $nombre = $request->nomb_producto;
        $descripcion = $request->descripcionProducto;
        $descuento = $this->preparaDescuento();
        $gos_producto_id = $request->gos_producto_id;
        $cantidad = $request->gos_producto_cantidad;
        $precio_materiales = $request->gos_producto_venta;
        $codigo_sat = $request->codigo_sat;
        //
        $this->setTipo_item($tipo_item);
        $this->setGos_os_id($gos_os_id);
        $this->setDescuento($descuento);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setGos_producto_id($gos_producto_id);
        $this->setCantidad($cantidad);
        $this->setTipo_item($tipo_item);
        $this->setCodigo_sat($codigo_sat);
        
        // precio de etapa
        $this->setPrecio_materiales($precio_materiales);
        //
        return $this->datosEntidad($request);
    }

    /**
     *
     * @param unknown $request            
     * @return unknown
     */
    protected function guardaDatosPaquete($request)
    {
        // obtener el id de os
        $gos_os_id = $request->gos_os_id_PaqueteItem;
        // si os es mayor a cero
        $gos_paquete_id = $request->gos_paquete_id;
        // consultar items del paqeute elegido
        $itemsPaq = Gos_V_Items_Paquetes::where('gos_paquete_id', $gos_paquete_id)->get();
        // recorrer todos los items del paqeute
        foreach ($itemsPaq as $item) {
            $datos = $this->datosEntidad($item);
            $gos_os_id = $dato['gos_os_id'];
            // agrear item a la os
            $item = new Gos_Os_Item($datos);
            $item->save();
        }
        
        return $gos_os_id;
    }

    /**
     *
     * @return string
     */
    protected function sinAsignar()
    {
        // obtener datos
        $sinAsignar = 'Sin Asignar';
        return $sinAsignar;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_os_id)
    {
        return $this->obtenListaItems($gos_os_id);
    }

    /**
     *
     * @param unknown $gos_os_id            
     * @return \App\Http\Controllers\Gos\unknown|\App\Http\Controllers\Gos\NULL|unknown
     */
    private function obtenListaItems($gos_os_id)
    {
        $itemsOS = $this->listadoFiltrado($gos_os_id);
        $ajax = $this->preparaDataTableAjax($itemsOS, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {}
        
        return Response::json($itemsOS);
    }

    /**
     *
     * @param unknown $gos_os_id            
     * @return unknown|array
     */
    public static function listadoFiltrado($gos_os_id)
    {
        return Gos_V_Os_Items::where('gos_os_id', $gos_os_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_os_item_id)
    {
        $gos_os_item = Gos_Os_Item::where('gos_os_item_id', $gos_os_item_id)->delete();
        $gos_os_id = $gos_os_item->gos_os_id;
        return $this->obtenListaItems($gos_os_id);
    }

    /**
     *
     * @return string
     */
    protected function tipoItemOSPaquete()
    {
        return GosSistemaParametrosController::valorTexto('tipo_item_os_paq');
    }

    /**
     *
     * @return string
     */
    protected function tipoItemOSEtapa()
    {
        return GosSistemaParametrosController::valorTexto('tipo_item_os_etapa');
    }

    /**
     *
     * @return string
     */
    protected function tipoItemOSProducto()
    {
        return GosSistemaParametrosController::valorTexto('tipo_item_os_pr');
    }
}
