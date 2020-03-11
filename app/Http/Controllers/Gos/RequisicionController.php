<?php

namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use App\Gos\Gos_Requisicion;
use App\Gos\Gos_Requisicion_Item;
use App\Gos\Gos_V_Os_Vehiculo;
use App\Gos\Gos_V_Requisiciones;

use GosClases\Producto;
use App\Http\Controllers\Gos\ProveedoresController;

use Session;

class RequisicionController extends GosControllers
{
    protected $vistaListado = 'Requisicion/ListaRequisicion';

    protected $opcionesEditDataTable = 'Requisicion.OpcionesRequisicionDT';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado = Gos_V_Requisiciones::where(self::condIdTaller())->get();

        $ajax = $this->preparaDataTableAjax($listado, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }

        $listaProveedores = ProveedoresController::listadoGeneral();
        $listaProductos = Producto::listaProductos();

        return view($this->getVistaListado(),compact('listaProveedores','listaProductos'));

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
        return $this->guardaJson($request);
    }

    protected function guardaJson(Request $request, $id = 0)
    {
        $requisicion = $this->preparaDatos($request);

        if (isset($request->cantidad)){
            $this->guardaItemRequisicion($request);
        }

        return Response::json($requisicion);
    }

    protected function preparaDatos(Request $request)
    {
        $requisicion = null;
        $gos_requisicion_id = isset($request->gos_requisicion_id) ? $request->gos_requisicion_id : 0;
        
        $datos = $this->datosEntidad($request);

        if ($gos_requisicion_id > 0) {
            $requisicion = Gos_Requisicion::find($gos_requisicion_id)->update($datos);
        } else {
            $requisicion = new Gos_Requisicion($datos);
            $requisicion->save();
            $gos_requisicion_id = $requisicion->gos_requisicion_id;
        }
        $this->setEntidad_id($gos_requisicion_id);

        return $gos_requisicion_id;
    }

    protected function datosEntidad($request)
    {          
        $fecha_solicitud = date("Y-m-d H:i:s",strtotime($request->fecha_Solicitud));

        $datos = [
            'gos_taller_id' => self::tallerIdActual(),
            'gos_os_id' => $request->gos_os_id,
            'gos_proveedor_id' => $request->gos_proveedor_id,
            'gos_vehiculo_id' => $request->gos_vehiculo_id,
            'fecha_solicitud' => $fecha_solicitud
        ];
        return $datos;
    }

    protected function guardaItemRequisicion($request)
    {   
        $gos_requisicion_id = $this->getEntidad_id();

        $item = null;
        $gos_requisicion_item_id = isset($request->gos_requisicion_item_id) ? $request->gos_requisicion_item_id : 0;

        $datos = [
            'gos_requisicion_id' => $gos_requisicion_id,
            'gos_producto_id' => $request->gos_producto_id,
            'cantidad' => $request->cantidad
        ];

        if ($gos_requisicion_item_id > 0) {
            $item = Gos_Requisicion_Item::find($gos_requisicion_item_id)->update($datos);
        } else {
            $item = new Gos_Requisicion_Item($datos);
            $item->save();
        }

        return $item;
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicion = Gos_V_Requisiciones::where(self::condIdTaller())
                                            ->where('gos_requisicion_id',$id)
                                            ->first();
        
        return Response::json($requisicion);                                           

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
    public function destroy($gos_requisicion_id)
    {
        $requisicion = Gos_Requisicion::find($gos_requisicion_id);
        $requisicion->delete();
        return Response::json($requisicion);
    }

    /**
     * Devuelve lista de Clientes/Vehiculos para seleccionar en orden de Servicio
     *
     * @param Request $request
     * @return string
     */
    public function listaVehiculos()
    {
        $Vehiculos = Gos_V_Os_Vehiculo::where('gos_taller_id',Session::get('taller_id'))->get();
        return $this->preparaDatosDataTable($Vehiculos, 1);
    }

}
