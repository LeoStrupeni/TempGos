<?php

namespace App\Http\Controllers\Gos\OS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use session;
use App\Gos\Gos_V_Aseguradoras_;
use App\Gos\Gos_Ot;
use App\Gos\Gos_OS_Riesgo;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_Metodo_Pago;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Medidor_Gas;
use App\Gos\Gos_Vehiculo_Tipo;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_Producto;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Color;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_Os_Anticipo;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Paquete_Item;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Pres;

class EditarOSController extends Controller
{
    public function index($id)
    {     //LISTADOS---------------------
          $idtaller=Session::get('taller_id');
          $usuario_id = Session::get('usr_Data');
          $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
          $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
          $listaAseguradoras = Gos_V_Aseguradoras_::where('gos_taller_id',$idtaller)->get();
          $listaTot = Gos_Ot::where('gos_taller_id',$idtaller)->get();
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
          $listadoAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id', 1)->get();
          $listaTecnicos = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id',2)->get();
          $listaMarcas=Gos_Vehiculo_Marca::where('gos_taller_id', $idtaller)->get();
          $coloresVehiculo= Gos_Color::all();

          //___________________________________OS-_______________________________________________________________________________
          $os=Gos_V_Os::find($id);
          if ($os==null) {
            return back();
          }
          $ositems=Gos_V_Os_Items::where('gos_os_id',$id)->orderby('orden_etapa')->get();
          $anticipos=Gos_Os_Anticipo::where('gos_os_id',$id)->get();
          $compact=compact('listaAseguradoras','listaTot','listaRiesgos','listaTipoOrden','listaDanios','listaEstadosExp','listaEtapas','listaServicios','listaPaquetes','listaProductos'
           ,'listadoAsesores','listaMetodos','os','ositems','taller_conf_ase','taller_conf_vehiculo','anticipos','listaTecnicos');
         return view('/OS/EditarOS',$compact);
    }

      public function editar($id,Request $request)
      {
        $pres = Gos_Pres::where('gos_pres_os_id',$id)->first();
        $os=Gos_Os::find($id);
        if ($request->clienteid>0) {
          $os->gos_cliente_id=$request->clienteid;
        }
        if ($request->vehiculoid>0) {
          $os->gos_vehiculo_id=$request->vehiculoid;
        }
        $os->gos_aseguradora_id=$request->gos_aseguradora_id;
        $os->nro_reporte=$request->nro_reporte;
        $os->nro_siniestro=$request->nro_siniestro;
        $os->nro_poliza=$request->nro_poliza;
        $os->gos_os_riesgo_id=$request->gos_os_riesgo_id;
        $os->gos_os_tipo_o_id=$request->gos_os_tipo_o_id;
        $os->gos_os_tipo_danio_id=$request->gos_os_tipo_danio_id;
        $os->gos_os_estado_exp_id=$request->gos_os_estado_exp_id;
        $os->descuento_tipo=$request->descuento_tipo;
        $os->subtotal=$request->subtotal;
        $os->iva=$request->iva;
        $os->demerito=$request->demerito;
        $os->deducible=$request->deducible;
        $os->gos_ot_id=$request->gos_ot_id;
        $os->fecha_ingreso_v_os=$request->fecha_ingreso_v_os;
        $os->fecha_promesa_os=$request->fecha_promesa;
          //------------------------------------------------------------Valuacion qualitas--------------------------------------------------------------------------------
          $fechaingreso=$os->fecha_ingreso_v_os;
          if($pres!=null && $fechaingreso!=0){
            if($pres->gos_pres_estatus==1){

                $valuacionpres=$pres->valuacion;

                if($valuacionpres!=null){
                    $tipoval = explode("V", $valuacionpres);

                    $date = strtotime($fechaingreso);
                    $day = date('l', $date);

                          if($tipoval[1]==0){
                            if($day=='Monday'){$diasval = date("Y-m-d H:i:s", strtotime($fechaingreso));}
                            if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 1 days'));}
                            if($day=='Sunday'){$diasval = date("Y-m-d H:i:s", strtotime($fechaingreso));}
                            $os->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 4 days'));//4
                          }
                          if($tipoval[1]==1){
                            if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                            if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                            if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 3 days'));}
                            if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                            $os->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 7 days'));//7
                          }
                          if($tipoval[1]==2){
                            if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                            if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                            if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                            if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                            if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                            if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 5 days'));}
                            if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                            $os->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 14 days'));//14
                          }
                          if($tipoval[1]==3){
                            if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                            if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                            if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                            if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                            if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                            if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 11 days'));}
                            if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                            $os->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 28 days'));//28
                          }
                          if($tipoval[1]==4){
                            if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                            if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                            if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                            if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                            if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                            if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 17 days'));}
                            if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 16 days'));}
                            $os->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 45 days'));//45
                          }
                }
            }
         }
      //--------------------------------------------------------------------------------------------------------------------------------------------
        $os->nro_orden=$request->nro_orden;
        $os->save();
        if ($request->tipoAnticipo=="si") {
          $anticipo=Gos_Os_Anticipo::where('gos_os_id',$id)->first();
          if($anticipo==Null){$anticipo= new Gos_Os_Anticipo();}
          $anticipo->gos_forma_pago_id=$request->gos_metodo_pago_id;
          $anticipo->fecha_abono=$request->fecha_abono;
          $anticipo->monto_abono=$request->monto_abono;
          $anticipo->observaciones=$request->observacionesAnticipo;
          $anticipo->save();
        }
        $ositem= Gos_OS_Item::where('gos_os_id',$id)->get();
        foreach ($ositem as $current) {
          if($current->gos_producto_id==null || $current->gos_producto_id<1){
           $current->orden_etapa=$request->orden[$current->gos_os_item_id];
           $current->precio_etapa=$request->precioeta[$current->gos_os_item_id];
           $current->save();
         }
        }

       return redirect('/ordenes-servicio');
      }

     public function eliminaritem($id){
         $ositem= Gos_OS_Item::find($id);
         $ositem->delete();
         return back();
     }

     public function agregaretapa($osid,$etapaid,$servicioid,$total,$manodeobra){
       $lastItem=Gos_Os_Item::where('gos_os_id',$osid)->orderBy('orden_etapa','desc')->first();
       $idtaller=Session::get('taller_id');
       $etapadereferencia=Gos_Paq_Etapa::where('gos_paq_etapa_id',$etapaid)->first();
       $OSITM= new Gos_Os_Item();
       $OSITM->gos_os_id=$osid;
       $OSITM->gos_paq_etapa_id=$etapadereferencia->gos_paq_etapa_id;
       $OSITM->gos_usuario_asesor_id=$etapadereferencia->gos_usuario_tecnico_id;
       $OSITM->gos_paq_servicio_id=$servicioid;
       $OSITM->gos_taller_id=$idtaller;
       $OSITM->precio_etapa=$total;
       $OSITM->precio_mo=$manodeobra;
       $OSITM->orden_etapa=($lastItem->orden_etapa+1);
       $OSITM->save();
       return back();
     }

    public function agregarpaquete($osid,$paqueteid){
      $estadoEtapa="A"; $lastOrder=0;
      $lastItem=Gos_Os_Item::where('gos_os_id',$osid)->orderBy('orden_etapa','desc')->first();
      if ($lastItem!=null) {
      $lastOrder=$lastItem->orden_etapa;
      }
      $lastItemActive=Gos_Os_Item::where('gos_os_id',$osid)->where('estado_etapa',"A")->first();
      if ($lastItemActive!=null) {$estadoEtapa="NA";}
      $idtaller=Session::get('taller_id');
      $PaqItemRef=Gos_Paquete_Item::where('gos_paquete_id',$paqueteid)->orderBy('orden_etapa', 'ASC')->get();
      foreach ($PaqItemRef as $ItemRef) {
        $OSITM= new Gos_Os_Item();
        $OSITM->gos_os_id=$osid;
        $OSITM->gos_paquete_id=$ItemRef->gos_paquete_id;
        $OSITM->gos_paq_etapa_id=$ItemRef->gos_paq_etapa_id;
        $OSITM->gos_paq_servicio_id=$ItemRef->gos_paq_servicio_id;
        $OSITM->gos_usuario_asesor_id=$ItemRef->gos_usuario_asesor_id;
        $OSITM->precio_etapa=$ItemRef->precio_etapa;
        $OSITM->precio_mo=$ItemRef->precio_mo;
        $OSITM->precio_servicio=$ItemRef->precio_servicio;
        $OSITM->precio_materiales=$ItemRef->precio_materiales;
        $OSITM->orden_etapa=($ItemRef->orden_etapa+$lastOrder);
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
        $OSITM->estado_etapa=$estadoEtapa;
        $OSITM->save();
        $estadoEtapa="NA";
      }
      return back();
    }

    public function agregarproducto($osid,$prodid,$cantidad,$precio){
     $idtaller=Session::get('taller_id');
    $productoRef=Gos_Producto::where('gos_producto_id',$prodid)->first();
        $OSITM= new Gos_Os_Item();
        $OSITM->gos_os_id=$osid;
        $OSITM->gos_producto_id=$productoRef->gos_producto_id;
        $OSITM->precio_etapa=$precio;
        $OSITM->nombre=$productoRef->nomb_producto;
        $OSITM->descripcion=$productoRef->descripcion;
        $OSITM->codigo_sat=$productoRef->codigo_sat;
        $OSITM->cantidad=$cantidad;
        $OSITM->gos_taller_id=$idtaller;
        $OSITM->save();
        return back();
    }

    public function agregaranticipo($osid , Request $request){
      $fecha="";
     if ($request->fecha_abono!=null) {
       $fecha=date("Y-m-d", strtotime($request->fecha_abono));
     }
     $anticipo = new Gos_Os_Anticipo();
     $anticipo->gos_os_id=$osid;
     $anticipo->gos_forma_pago_id=$request->gos_metodo_pago_id;
     $anticipo->fecha_abono=$fecha;
     $anticipo->monto_abono=$request->monto_abono;
     $anticipo->observaciones=$request->observacionesAnticipo;
     $anticipo->save();
     return back();
    }
 public function ordenitem($osid,$itemid,$orden)
 {
   $itemact=Gos_Os_Item::find($itemid);
   if($orden==0){
     $ant=$itemact->orden_etapa-1;
     $itemswitch=Gos_Os_Item::where('gos_os_id',$osid)->where('orden_etapa',$ant)->first();
     if($itemswitch!=null){
       $itemswitch->orden_etapa=$itemact->orden_etapa;
       $itemswitch->save();
       $itemact->orden_etapa=$ant;
       $itemact->save();
     }else{
       $itemact->orden_etapa=$ant;
       $itemact->save();
     }
    }
    if($orden==1){
      $ant=$itemact->orden_etapa+1;
      $itemswitch=Gos_Os_Item::where('gos_os_id',$osid)->where('orden_etapa',$ant)->first();
      if($itemswitch!=null){
        $itemswitch->orden_etapa=$itemact->orden_etapa;
        $itemswitch->save();
        $itemact->orden_etapa=$ant;
        $itemact->save();
      }else{
        $itemact->orden_etapa=$ant;
        $itemact->save();
      }
    }
   return back();
 }

  public function estadoitem($itemid,$action){
  $itemswitch=Gos_Os_Item::find($itemid);
  $hoy = date("Y-m-d H:i:s");
  if ($action==0) {
     $itemswitch->estado_etapa="NA";
     $itemswitch->save();
  }
  if ($action==1) {
    $itemswitch->estado_etapa="A";
    $itemswitch->fecha_inicio_et=$hoy;
    $itemswitch->save();
    }
    return back();
  }

}//CLASS
