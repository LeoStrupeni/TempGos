<?php
namespace App\Http\Controllers\Gos\OS;

use Illuminate\Http\Request;
use GosClases\ItemsOS;
use App\Http\Controllers\Gos\GosControllers;
use App\Gos\Gos_V_Os_Items;
use GosClases\GosDataTable;
use GosClases\PaqueteItems;
use GosClases\Producto;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Os_Item;
use GosClases\GosSistema;
use GosClases\PaqueteOS;
use App\Gos\Gos_V_Lic_Paq_Servicio;
use App\Gos\Gos_Paq_Servicio;
use App\Gos\Gos_Usuario_Tecnico_Comision;
use session;
use \Response;
use App\Gos\Gos_Os_Orden_Finalizadas;
use App\Gos\Gos_Producto_Ubic_Stock;

/**
 * Controller para items de OS
 *
 * @author yois
 *
 */
class ItemOSController extends GosControllers
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
    public function listaServicios($gos_os_id)
    {
        $listaServicios = Gos_V_Os_Items::where('gos_os_id',$gos_os_id)->where('gos_paq_servicio_id','<>', '')->get();

        $ajax = $this->preparaDataTableAjax($listaServicios, 'OS.Items.OpcionesItemsDatatable');
        if (null != $ajax) {
            return $ajax;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->guardaItemPorTipo($request);
    }

    /**
     *
     * @param unknown $request
     * @return unknown
     */
    public function guardaItemPorTipo($request)
    {
        $paquete_id = $request->gos_paq_etapa_id;
        $gos_paq_servicio_id = isset($request->gos_paq_servicio_id) ? $request->gos_paq_servicio_id : 0;
        $gos_producto_id = isset($request->gos_producto_id) ? $request->gos_producto_id : 0;
        // inicializar datos a guardar
        $datos = [ // TECNICO ASESOR
            'gos_usuario_tecnico_id' => 0,
            'gos_paq_etapa_id' => $request->gos_paq_etapa_id,
            'gos_paquete_id' => 0,
            'gos_paq_servicio_id' => $request->gos_paq_servicio_id,
            'gos_producto_id' => $gos_producto_id,
            'descripcion' => '',
            'servicio' => '',
            'precio_etapa' => 0,
            'precio_servicio' => 0,
            'descuento' => 0,
            'tipo_item' => '',
            'estado_etapa' => GosSistema::etapaPendiente(),
            'orden_etapa' => 0,
            'comision_asesor' => 0,
            'comision_asesor_tipo' => GosSistema::obtenTipoComision(),
            'tiempo_meta' => 1,
            'materiales' => 0,
            'destajo' => 0,
            'minimo_fotos' => 0,
            'genera_valor' => 0,
            'complemento' => 0,
            'refacciones' => 0,
            'link' => ''
        ];
        $item_tipo = $request->item_tipo;
        $gos_os_id = 0;
        // Dependiendo del tipo de item elegido
        switch ($item_tipo) {
            case 'Etapa':
                $datos = PaqueteItems::datosEntidad($request); // $this->datosItemEtapas($datosItem);
                $datos['gos_os_id'] = $request->gos_os_id_EtapaItem;
                $datos['gos_paq_etapa_id'] = $request->gos_paq_etapa_id;
                $datos['gos_producto_id'] = $gos_producto_id;
                $datos['gos_paq_servicio_id'] =  $gos_paq_servicio_id;
                $datos['nombre'] = $request->nomb_etapa;
                $datos['descripcion'] = $request->descripcion_etapa;
                $datos['servicio'] = $request->nomb_servicio;
                $datos['tipo_item'] = GosSistema::itemOsEtapa();
                // terminarlo dentro de clase ItemsOS
                $gos_os_id = $this->guardaItemOS($datos);
                break;
            case 'Producto':
                $datos = Producto::datosItemProducto($request);
                $datos['gos_os_id'] = $request->gos_os_id_ProductoItem;
                $datos['gos_producto_id'] = $gos_producto_id;
                $datos['tipo_item'] = GosSistema::itemOsProducto();
                // terminarlo dentro de clase ItemsOS
                $gos_os_id = $this->guardaItemProductOS($datos);
                break;
            default:
                $gos_os_id = $request->gos_os_id_PaqueteItem;
                $gos_paquete_id = $request->gos_paquete_id;
                $datos = PaqueteOS::preparaGuardaPaquete($gos_os_id, $gos_paquete_id);
                break;
        }
        return Response::json($datos);
    }

    /**
     *
     * @param
     *            datos
     */
    private function guardaItemOS($datos)
    {

        $etapas = Gos_Os_Item::where( 'gos_os_id',  $datos['gos_os_id'])->get();
        $etapaRevisar =  isset($datos['gos_paq_etapa_id']) ? $datos['gos_paq_etapa_id'] : 0;;
        $bandera = true;
        $id = 0;
        foreach ($etapas as $etapa) {
            if ($etapaRevisar == $etapa->gos_paq_etapa_id) {
                $bandera = false;
            }
        }
        if($bandera){
            $item = new Gos_Os_Item($datos);
            $item->save();
            $gos_os_id = $item->gos_os_id;
            $id = $item->gos_os_item_id;

        }
        else{
            $gos_os_id =0;
        }

        $gos_item =    Gos_Os_Orden_Finalizadas::where('gos_os_id',$gos_os_id)->where('estado_etapa','A')->count();
        if($gos_item == 0){
            $item = Gos_Os_Item::find($id);
            $item->estado_etapa = 'A';
            $item->fecha_inicio_et = date("Y-m-d h:i:s");
            $item->save();

        }
        return $gos_os_id;
    }
    private function guardaItemProductOS($datos)
    {
        $etapas = Gos_Os_Item::where( 'gos_os_id',  $datos['gos_os_id'])->get();
        $etapaRevisar =  $datos['gos_producto_id'];
        $bandera = true;

        foreach ($etapas as $etapa) {
            if ($etapaRevisar == $etapa->gos_producto_id) {
                $bandera = false;
            }
        }
        if($bandera){
            $item = new Gos_Os_Item($datos);
            $item->save();
            $gos_os_id = $item->gos_os_id;
        }
        else{
            $gos_os_id =0;
        }
        return $gos_os_id;
    }


    public function agregarInventarioIntOS(Request $request){
        $etapas = Gos_Os_Item::where( 'gos_os_id',  $request->gos_os_id)->get();
        $bandera = true;

        $producto =  $request->gos_producto_id;    
        $existProducto = Gos_Producto_Ubic_Stock::where('gos_producto_id',$producto)->first();
        $osProducto = Gos_Os_Item::where('gos_producto_id', $producto)->where('gos_os_id',$request->gos_os_id)->first();

        if($existProducto->ingreso < $request->cantidad){
            return 0 ;
        }
        else if(isset($osProducto)){
            $sumaCantidad = $osProducto->cantidad + $request->cantidad;
            Gos_Os_Item::where('gos_producto_id', $producto)
                        ->where('gos_os_id',$request->gos_os_id)
                        ->update(['cantidad' => $sumaCantidad,
                                'precio_materiales' => $request->precio_materiales]);

            $restante = $existProducto->ingreso - $request->cantidad;
            $existProducto->ingreso = $restante;
            $existProducto->save();

            $os = Gos_OS::find($request->gos_os_id);
            $subtotalOs = $os->subtotal;
            $producto =$request->precio_venta*$request->cantidad;
            $subtotalProducto = $producto-$request->descuento;
            $subT = $subtotalOs+$subtotalProducto;
            $subtotal = Gos_OS::where('gos_os_id',$request->gos_os_id)->update(['subtotal' => $subT]);

            return 1 ;
        }
        else{
            // foreach ($etapas as $etapa) {
            //     if ($etapaRevisar == $etapa->gos_producto_id) {
            //         $bandera = false;
            //     }
            // }
            // if($bandera){
            $item = new Gos_Os_Item([
                'gos_producto_id'=> $request->gos_producto_id,
                'gos_os_id'=> $request->gos_os_id,
                'precio_materiales' => $request->precio_materiales,
                'codigo_sat'=> $request->codigo_sat,
                'descuento' => $request->descuento,
                'cantidad' => $request->cantidad
            ]);
            $item->save();

            $restante = $existProducto->ingreso - $request->cantidad;
            $existProducto->ingreso = $restante;
            $existProducto->save();

            $os = Gos_OS::find($request->gos_os_id);
            $subtotalOs = $os->subtotal;
            $producto =$request->precio_venta*$request->cantidad;
            $subtotalProducto = $producto-$request->descuento;
            $subT = $subtotalOs+$subtotalProducto;
            $subtotal = Gos_OS::where('gos_os_id',$request->gos_os_id)->update(['subtotal' => $subT]);

            return 1;
            // }
            // else{
            //     return $etapas;

            //     $gos_os_id =0;
            // }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param int $gos_os_id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_os_id)
    {
        return $this->preparInfoDataTable($gos_os_id);
    }

    /**
     *
     * @param unknown $gos_os_id
     * @return \GosClases\unknown|\GosClases\NULL
     */
    private function preparInfoDataTable($gos_os_id)
    {
        $lista = ItemsOS::listaItemsOSPorId($gos_os_id);
        $op = $this->getOpcionesEditDataTable();
        $dataTable = $this->preparaDataTableAjax($lista, $op);
        return $dataTable;
    }
    public function preparInfoProductoDataTable($gos_os_id)
    {
        $lista = ItemsOS::listaItemsProductoOSPorId($gos_os_id);
        $op = $this->getOpcionesEditDataTable();
        $dataTable = $this->preparaDataTableAjax($lista, '');
        return $dataTable;
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
    public function destroy($gos_os_item)
    {
        return Response::json(ItemsOS::borraItemOS($gos_os_item));
    }

    public function getItmServicios($id){
     $idtaller=Session::get('taller_id');
     $Etapas=gos_os_item::where('gos_os_id',$id)->where('gos_paq_servicio_id',0)->get();
     return($Etapas);
    }

    public function AgregarServicio($id,Request $request)
    {
     $idtaller=Session::get('taller_id');
     $servicio =new Gos_Os_Item();
     $servicio->gos_os_id=$id;
     $servicio->gos_paq_servicio_id=$request->gos_servicio_id;
     $servicio->cantidad=$request->gos_servicio_cantidad;
     $servicio->precio_servicio=$request->gos_servicio_venta;
     $servicio->descripcion=$request->descripcion_servicio;
     $servicio->save();
      return($request);
    }

    public function TecnicoServicio(Request $request){
      
      $total=0;$porcentaje=0;$cantidad=0;$ppitem=0;
      $porc="PORCIENTO"; $prec="PESOS";
      $ositmid=$request->OSitemid;
      $ppitem=$request->inputPoP;
      $cantidad=$request->Cantidad;
      $actiontype=$request->PorcCant;
      $item=Gos_Os_Item::find($ositmid);
      $gos_os_idd=gos_os_item::where('gos_os_item_id',$ositmid)->select("gos_os_id")->first();
      $gosnamease = Gos_V_Os::where('gos_os_id',$gos_os_idd->gos_os_id)->select('nomb_aseguradora')->first();
      $gosnameaseguradora = $gosnamease->nomb_aseguradora;
      $estatus = explode("|", $gosnameaseguradora);

      if($estatus[16]!='Transito'){
        if ($actiontype=="%") {
            $porcentaje=$request->inputPoP;
            $total=$item->precio_etapa;
            $total=($total*$porcentaje)/100;
            $item->comision_asesor=$total;
            $item->precio_mo=$total;
            $item->comision_asesor_tipo=$porc;
            $item->gos_usuario_tecnico_id=$request->Tecnico;
            $item->save();
            }
            if ($actiontype=="$") {
              $total=($ppitem)*($cantidad);
              $item->comision_asesor=$total;
              $item->precio_mo=$total;
              $item->comision_asesor_tipo=$prec;
              $item->gos_usuario_tecnico_id=$request->Tecnico;
              $item->save();
            }
            if ($actiontype==null) {
              $total=($ppitem)*($cantidad);
              $item->comision_asesor=$total;
              $item->precio_mo=$total;
              $item->comision_asesor_tipo=$prec;
              $item->gos_usuario_tecnico_id=$request->Tecnico;
              $item->save();
            }
            return($request);
      }
      else{
          return('Transito');
      }
    }

    public function TecnicoServicioAutocal($ido)
    {
      $total=0;$porcentaje=0;$cantidad=0;$ppitem=0;
      $itemsOS=Gos_Os_Item::where('gos_os_id',$ido)->where('gos_paq_servicio_id','>',0)->where('gos_usuario_tecnico_id','>',0)->get();
      foreach ($itemsOS as $itemS) {
      $params=Gos_Usuario_Tecnico_Comision::where('gos_usuario_id',$itemS->gos_usuario_tecnico_id)->first();
      if ($params->tipo_comision=="PORCIENTO") {
        $porcentaje=$params->monto_comision;
        $total=$itemS->precio_etapa;
        $total=($total*$porcentaje)/100;
        $itemS->comision_asesor=$total;
        $itemS->precio_mo=$total;
        $itemS->save();
      }
      if ($params->tipo_comision=="PESOS") {
        if ($itemS->precio_mo==0 ||$itemS->precio_mo==""||$itemS->precio_mo==NULL) {
          $total=$params->monto_comision;
          $itemS->comision_asesor=$total;
          $itemS->precio_mo=$total;
          $itemS->save();
        }
      }
      }
      return("calcautoFcontroller");
    }

    public function TecnicoParams($id)
    {
      $params=Gos_Usuario_Tecnico_Comision::where('gos_usuario_id',$id)->first();
      return($params);
    }

   public function EliminarServicio($id)
   {
      $item=Gos_Os_Item::find($id);
      $item->delete();
      return($item);
   }
    public function GuardarServicios($id,Request $request){


    $total=0;$descuento=0;
     $items=Gos_Os_Item::where('gos_os_id',$id)->where('gos_paq_servicio_id','>',0)->get();
     foreach ($items as $item) {
     $total=$item->precio_mo;
     $descuento=(($request->input('descuento'.$item->gos_os_item_id)*$item->precio_mo)/100);
     $calc=$total-$descuento;
     $item->precio_mo=$calc;
     $item->save();
       }
      return($request);
    }

   
}
