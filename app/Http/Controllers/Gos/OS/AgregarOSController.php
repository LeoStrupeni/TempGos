<?php

namespace App\Http\Controllers\Gos\Os;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use session;
use App\Gos\Gos_V_Aseguradoras_;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Paquete_Item;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_Ot;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_OS_Riesgo;
use App\Gos\Gos_Metodo_Pago;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Medidor_Gas;
use App\Gos\Gos_Vehiculo_Tipo;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_Producto;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_Vehiculo_Inventario;
use App\Gos\Gos_OS;
use App\Gos\Gos_Os_Anticipo;
use App\Gos\Gos_Vehiculo_Inventario_Parte;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Color;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Taller_Conf_vehiculo;

class AgregarOSController extends Controller
{

     public function AgregarOSget(){
       $hoy = date("Y-m-d H:i:s");

       $condIdTaller=Session::get('taller_id');
       $listaAseguradoras = Gos_V_Aseguradoras_::where('gos_taller_id',$condIdTaller)->get();
       $listaTot = Gos_Ot::where('gos_taller_id',$condIdTaller)->get();
       $listaTipoOrden = Gos_OS_Tipo_O::all();
       $listaDanios = Gos_OS_Tipo_Danio::all();
       $listaEstadosExp = Gos_OS_Estado_Exp::all();
       $listaRiesgos = Gos_OS_Riesgo::all();
       $listaMetodos = Gos_Metodo_Pago::all();
       $listaInteriores = Gos_Vehiculo_Parte::where('tipo', 'Interiores')->get();
       $listaExteriores = Gos_Vehiculo_Parte::where('tipo', 'Exteriores')->get();
       $listaMotores = Gos_Vehiculo_Parte::where('tipo', 'Motor')->get();
       $listaCajuela = Gos_Vehiculo_Parte::where('tipo', 'Cajuela')->get();
       $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
       $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
       $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();
       $listaServicios = Gos_V_Paq_Servicios::where('gos_taller_id',Session::get('taller_id'))->get();
       $listaPaquetes = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->get();
       $listaProductos = Gos_Producto::where('gos_taller_id',Session::get('taller_id'))->get();
       $idtaller=Session::get('taller_id');
       $listadoAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id', 1)->get();
       $listaMarcas=Gos_Vehiculo_Marca::where('gos_taller_id', $idtaller)->get();
       $usuario=Session::get('usr_Data');
       $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
       $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
       $coloresVehiculo= Gos_Color::all();
       $aseguradora = null;
       $tot = null;
       $riesgo = null;
       $danio = null;
       $orden = null;
       $estado = null;
       $usuario_id = Session::get('usr_Data');
       $usuario = $usuario_id['gos_usuario_id'];
       $inventario= new Gos_Vehiculo_Inventario();
       $compact=compact('usuario','listaAseguradoras','listadoAsesores', 'listaTot', 'listaTipoOrden', 'listaDanios', 'listaEstadosExp', 'listaRiesgos', 'listaMetodos','listaInteriores','listaExteriores','listaMotores','listaCajuela','listaMedidorGas','listaTipoVehiculo','listaEtapas', 'listaServicios', 'listaPaquetes','listaProductos', 'aseguradora','tot',
       'riesgo','danio','orden','estado','inventario','hoy','listaMarcas','coloresVehiculo','taller_conf_vehiculo','taller_conf_ase');

       return view('/OS/AgregarOS', $compact);
     }

     public function  AgregarOSpost(Request $request){
              //  $IDOSAC=0; $idtaller

              $rules =[
                   'gos_cliente_id'=>'required',
                   'gos_aseguradora_id'=>'required',
                   'gos_os_riesgo_id'=>'required',
                   'gos_os_estado_exp_id' => 'required',
                   'fecha_creacion_os' => 'required',

                    ];
                    $messages=[
                  'gos_cliente_id.required'=>'Ingrese el Cliente',
                  'gos_aseguradora_id.required'=>'Seleccione La Aseguradora',
                  'gos_os_riesgo_id.required'=>'Seleccione El Riesgo',
                  'gos_os_estado_exp_id.required'=>'Ingrese El Estatus',
                  'fecha_creacion_os.required'=>'Ingrese Fecha Creacion',

                     ];
                    $this->validate($request, $rules,$messages);

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                  $index = rand(0, strlen($characters) - 1);
                  $randomString .= $characters[$index];
                }
                $tokenseguimiento=$randomString;
                $ligaTokenseguimiento='/LigaSeguimiento/'.$randomString;
           //___________________________________________creacion de token_______________________________

                $usr=Session::get('usr_Data');
                $idtaller=Session::get('taller_id');
                $valOS=Gos_OS::where('gos_taller_id',$idtaller)->get();
                $max = sizeof($valOS);
               if ($max!=0) {
                 $latestID=DB::select( DB::raw('select nro_orden_interno as lastid from gos_os where gos_taller_id='.$idtaller.' ORDER BY gos_os_id DESC limit 1;'));
                 $UltimaOrder=$latestID[0]->lastid;
                 if ($UltimaOrder<1) { $UltimaOrder=1;}
                 else {$UltimaOrder=$UltimaOrder+1;}
               }
               else{$UltimaOrder=1;}
                  $OS=new Gos_OS();
                    $OS->gos_cliente_id=$request->gos_cliente_id;
                    $OS->gos_taller_id=$idtaller;
                    $OS->gos_aseguradora_id=$request->gos_aseguradora_id;
                    $OS->nro_reporte=$request->nro_reporte;
                    $OS->nro_orden=$request->nro_orden;
                    $OS->nro_siniestro=$request->nro_siniestro;
                    $OS->nro_orden_interno=$UltimaOrder;
                    $OS->nro_poliza=$request->nro_poliza;
                    $OS->gos_os_riesgo_id=$request->gos_os_riesgo_id;
                    $OS->gos_os_tipo_o_id=$request->gos_os_tipo_o_id;
                    $OS->gos_os_tipo_danio_id=$request->gos_os_tipo_danio_id;
                    $OS->gos_os_estado_exp_id=$request->gos_os_estado_exp_id;
                    $OS->gos_vehiculo_id=$request->gos_vehiculo_id;
                    $OS->descuento_tipo=$request->descuento_tipo;
                    $OS->subtotal=$request->subtotal;
                    $OS->iva=$request->iva;
                    $OS->demerito=$request->demerito;
                    $OS->deducible=$request->deducible;
                    if ($request->gos_ot_id!=null) {$OS->gos_ot_id=$request->gos_ot_id;}
                    else {$OS->gos_ot_id=0;}
                    $OS->fecha_creacion_os=$request->fecha_creacion_os;
                    if ($request->gos_os_estado_exp_id==2) {$OS->fecha_ingreso_v_os=0;}
                    else {
                    $OS->fecha_ingreso_v_os=$request->fecha_ingreso_v_os;
                    }
                    if ($request->fecha_promesa!=null) {$OS->fecha_promesa_os=$request->fecha_promesa;}
                    else{$OS->fecha_promesa_os=0;}
                    if ($request->descuentoe=="%") {
                      $OS->descuento_tipo="PORCIENTO";
                    }
                    if ($request->descuentoe=="$") {
                      $OS->descuento_tipo="PESOS";
                    }

                    $OS->anticipo=$request->tipoAnticipo;
                    $OS->gos_os_token_seguimiento=$tokenseguimiento;
                    $OS->gos_os_liga_seguimiento=$ligaTokenseguimiento;
                    $OS->gos_usuario_id=$usr->gos_usuario_id;
                    $OS->ing_grua=$request->IGrua;
                    $OS->con_especiales=$request->Cespeciales;
                    $OS->save();
                    $IDOSAC=$OS->gos_os_id;
                  //___________________________________________Anticipo_________________
                     $fechaant = date("Y-m-d ");
                    if($request->tipoAnticipo=="si"){
                     $antic=new Gos_Os_Anticipo();
                     $antic->gos_os_id=$IDOSAC;
                     $antic->gos_forma_pago_id=$request->gos_metodo_pago_id;
                     $antic->fecha_abono=$fechaant;
                     $antic->monto_abono=$request->monto_abono;
                     $antic->observaciones=$request->observacionesAnticipo;
                     $antic->save();
                    }
                  //_________________________________________Inventario____________________________________________
                  $Invent= new Gos_Vehiculo_Inventario();
                    $Invent->gos_os_id=$IDOSAC;
                    $Invent->gos_vehiculo_id=$request->gos_vehiculo_id;
                    $Invent->gos_vehiculo_medidor_gas_id=9;
                    $Invent->save();
                    $idINV=$Invent->gos_vehiculo_inventario_id;
                    $partesRef=gos_vehiculo_parte::all();
                         foreach ($partesRef as $partederef ) {

                           $parte= new Gos_Vehiculo_Inventario_Parte();
                           $parte->gos_vehiculo_inventario_id=$idINV;
                           $parte->gos_vehiculo_parte_id=$partederef->gos_vehiculo_parte_id;
                           $parte->save();
                         }
                //___________________________________________Agregar Item___________________________________________
                 //**____________________Producto
                     $cadProdS=$request->Productos;
                     $ProdS=explode(",",$cadProdS);
                     $cadCantProdS=$request->ProductosCant;
                     $ProdSCant=explode(",",$cadCantProdS);
                      $productoRef=Gos_Producto::whereIn('gos_producto_id',$ProdS)->get();
                      $iteProdCan=0;
                      foreach ($productoRef as $prodref) {
                        $OSITM= new Gos_Os_Item();
                        $OSITM->gos_os_id=$IDOSAC;
                        $OSITM->gos_producto_id=$prodref->gos_producto_id;
                        $OSITM->precio_etapa=$prodref->venta;
                        $OSITM->nombre=$prodref->nomb_producto;
                        $OSITM->descripcion=$prodref->descripcion;
                        $OSITM->codigo_sat=$prodref->codigo_sat;
                        $OSITM->cantidad=$ProdSCant[$iteProdCan];
                        $OSITM->save();
                        $iteProdCan=$iteProdCan+1;
                     }
                 //**____________________Paquete
                     $flagavtivateetapa=0; $orden=1;
                     $hoy = date("Y-m-d H:i:s");
                     $cadPaquete=$request->Paquetes;
                     $Paquetes=explode(",",$cadPaquete);
                     $estado_etapaAct="A";
                     $PaqItemRef=Gos_Paquete_Item::whereIn('gos_paquete_item_id',$Paquetes)->orderBy('orden_etapa', 'ASC')->get();
                     foreach ($PaqItemRef as $ItemRef) {
                       $OSITM= new Gos_Os_Item();
                       $OSITM->gos_os_id=$IDOSAC;
                       $OSITM->gos_paquete_id=$ItemRef->gos_paquete_id;
                       $OSITM->gos_paq_etapa_id=$ItemRef->gos_paq_etapa_id;
                       $OSITM->gos_paq_servicio_id=$ItemRef->gos_paq_servicio_id;
                       $OSITM->gos_usuario_asesor_id=$ItemRef->gos_usuario_asesor_id;
                       $OSITM->precio_etapa=$ItemRef->precio_etapa;
                       $OSITM->precio_mo=$ItemRef->precio_mo;
                       $OSITM->precio_servicio=$ItemRef->precio_servicio;
                       $OSITM->precio_materiales=$ItemRef->precio_materiales;
                       $OSITM->orden_etapa=$ItemRef->orden_etapa;
                       $OSITM->comision_asesor=$ItemRef->comision_asesor;
                       $OSITM->comision_asesor_tipo=$ItemRef->comision_asesor_tipo;
                       $OSITM->tiempo_meta=$ItemRef->tiempo_meta;
                       $OSITM->materiales=$ItemRef->materiales;
                       $OSITM->destajo=$ItemRef->destajo;
                       $OSITM->minimo_fotos=$ItemRef->minimo_fotos;
                       $OSITM->genera_valor=$ItemRef->genera_valor;
                       $OSITM->minimo_fotos=$ItemRef->minimo_fotos;
                       $OSITM->refacciones=$ItemRef->refacciones;
                       $OSITM->link=$ItemRef->link;
                       $OSITM->cantidad=$ItemRef->cantidad;
                       $OSITM->descuento=$ItemRef->descuento;
                       $OSITM->gos_taller_id=$idtaller;
                       $OSITM->estado_etapa=$estado_etapaAct;
                       if ( $estado_etapaAct=="A") {$OSITM->fecha_inicio_et=$hoy; $flagavtivateetapa=1;}
                       $OSITM->save();
                       $estado_etapaAct="NA";
                       $orden=$orden+1;
                     }

                     //**____________________Etapa Single

                         $cadETapasS=$request->Etapas;
                         $cadEtaSer=$request->EtapasSer;
                         $EtapasS=explode(",",$cadETapasS);
                         $arraylen=count($EtapasS);
                         $EtapasSerS=explode(",",$cadETapasS);
                         $EtRef=Gos_Paq_Etapa::whereIn('gos_paq_etapa_id',$EtapasS)->get();
                          $iteEtapaSingle=0;
                          $orden=$orden+1;
                         foreach ($EtRef as $etapadereferencia) {
                               $OSITM= new Gos_Os_Item();
                               $OSITM->gos_os_id=$IDOSAC;
                               $OSITM->gos_paq_etapa_id=$etapadereferencia->gos_paq_etapa_id;
                               $OSITM->gos_usuario_asesor_id=$etapadereferencia->gos_usuario_tecnico_id;
                               $OSITM->gos_paq_servicio_id=$EtapasSerS[$iteEtapaSingle];
                               $OSITM->gos_taller_id=$idtaller;
                               $OSITM->orden_etapa=$orden;
                               if ($flagavtivateetapa==0) {$OSITM->estado_etapa=$estado_etapaAct;}
                               if ( $estado_etapaAct=="A") {$OSITM->fecha_inicio_et=$hoy; $flagavtivateetapa=1;}
                               $OSITM->save();
                               $iteEtapaSingle=$iteEtapaSingle+1;
                               $estado_etapaAct="NA";
                               $orden=$orden+1;
                         }
                    return redirect('/orden-servicio-generada/'.$IDOSAC);

         }

     public function getEtapasTaller($id){
         $idtaller=Session::get('taller_id');
          $etapa=Gos_Paq_Etapa::find($id);
          return($etapa);
     }
     public function getPaquetesTaller($id){
         $idtaller=Session::get('taller_id');
         $paquete=Gos_Paq_Etapa::find($id);
         $paqitems=Gos_Paquete_Item::where('gos_paquete_id',$id )->get();
         $paqitems2=DB::select( DB::raw('select gos_paquete_item_id,orden_etapa,
                                    (select nomb_etapa from gos_paq_etapa where gos_paq_etapa_id=gos_paquete_item.gos_paq_etapa_id) as etapa,
                                    (select descripcion_etapa from gos_paq_etapa where gos_paq_etapa_id=gos_paquete_item.gos_paq_etapa_id)as descetapa ,
                                    (select nomb_servicio from gos_paq_servicio where gos_paq_servicio_id=gos_paquete_item.gos_paq_servicio_id) as servicio ,
                                    (select concat(nombre," ",apellidos) as asesor from  gos_usuario where gos_usuario_id=gos_paquete_item.gos_usuario_asesor_id) as asesor
                                    ,precio_etapa,precio_materiales from gos_paquete_item where gos_paquete_id='.$id.' order by orden_etapa'));
         return($paqitems2);
     }
     public function getEtProductoTaller($id){
         $idtaller=Session::get('taller_id');
         $producto=Gos_Producto::find($id);
       return($producto);
     }
    public function getAseguradoraVal($id){
      $val=Gos_V_Aseguradoras_::find($id);
      return($val);
    }



}
