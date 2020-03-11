<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Gos\Gos_Pres;
use App\Gos\Gos_V_Pres;
use App\Gos\Gos_Pres_Servicio;
use App\Gos\Gos_Pres_Item;
use App\Gos\Gos_Producto;
use App\Gos\Gos_Pres_Concepto;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Taller;
use App\Gos\Gos_V_Vehiculos;
use App\Gos\Gos_Vehiculo_Modelo;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Color;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_OS;
use App\Gos\Gos_Os_Refaccion;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_V_Os_Items;
use session;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use PDF;
/**
 *
 * @author yois
 *
 */
class PresupuestosController extends GosControllers
{

  protected $vistaListado = 'Presupuestos/ListarPresupuestos';

     protected $opcionesEditDataTable = 'Presupuestos.OpcionesPresupuestosDatatable';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();

      /**
       * Funcion que carga los datos de la lista General en el DAtatable y utiliza
       * $opcionesEditDataTable como opciones para edtiar/borrar que estan dentro del archivo
       * declarado en la variable $opcionesEditDataTable.
       *
       * @var Ambiguous $ajax
       */
      $ajax = $this->preparaDataTableAjax(self::listadoGeneral(), $this->getOpcionesEditDataTable());
      if (null !== $ajax) {
          return $ajax;
      }
      /**
       * Variable que trae listas para selects de modales
       *
       * @var Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static > $listaClientes
       */
      $idtaller=Session::get('taller_id');
      $todos=Gos_Pres::where('gos_taller_id',$idtaller)->count();
      $prendientes=Gos_Pres::where('gos_pres_estatus',0)->where('gos_taller_id',$idtaller)->count();
      $unidos=Gos_Pres::where('gos_pres_estatus',1)->where('gos_taller_id',$idtaller)->count();
      $procesados=Gos_Pres::where('gos_pres_estatus',2)->where('gos_taller_id',$idtaller)->count();
      $listaOrdenes=Gos_V_Os::where('gos_taller_id',$idtaller)->get();

      $gos_v_press =  Gos_V_Pres::where('gos_taller_id',$idtaller)->get();


      //return($listaOrdenes);
      $compact = compact('prendientes','procesados','unidos','todos','listaOrdenes','gos_v_press','taller_conf_vehiculo','taller_conf_ase');

      return view($this->getVistaListado(), $compact);

    }

    public static function listadoGeneral($criterio = '')
    {
        $idtaller=Session::get('taller_id');
        return Gos_V_Pres::where('gos_taller_id',$idtaller)->get();
    }

    public function AgregarPresupuesto(){
         $idtaller=Session::get('taller_id');
         $hoy = date("Y-m-d H:i:s");
         //$hoy = date('m/d/Y');
         $listaProductos=Gos_Producto::where('gos_taller_id',$idtaller)->get();
         $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$idtaller)->get();
         $listaModelos = Gos_Vehiculo_Modelo::all();
         $listaMarcas = Gos_Vehiculo_Marca::all();
         $coloresVehiculo = Gos_Color::all();
          return view('/Presupuestos/AgregarPresupuesto')->with(compact('listaProductos','listaConceptos','hoy','coloresVehiculo','listaMarcas','listaModelos'));
      }
    public function CrearPresupuesto(Request $request){

        $items=json_decode($request->Jsnitems);
        $pres= new Gos_Pres();
        if ($request->gos_os_id>0) {$pres->gos_pres_os_id=$request->gos_os_id;}
        $pres->gos_cliente_id=$request->gos_cliente_id;
        $pres->gos_taller_id=Session::get('usr_Data.gos_taller_id');
        $fechaPres=$request->fecha_cotizacion;
        $pres->fecha=$fechaPres;
        $pres->gos_vehiculo_id=$request->gos_vehiculo_id;
        $pres->nro_poliza=$request->nro_poliza;
        $pres->nro_siniestro=$request->nro_siniestro;
        $pres->kilometraje=$request->kilometraje;
        $pres->iva=$request->Iva;
        $pres->descuento_tipo=$request->descuento_tipo;
        $pres->descuento=$request->Descuento;
        $pres->save();
        $presId=$pres->gos_pres_id;
        $items=json_decode($request->Jsnitems);
          foreach ($items as $item) {
            $nomenclatura=$item->nomen;
            $arrNOm = str_split($nomenclatura);
            $Item= new Gos_Pres_Item();
            $Item->gos_pres_id=$presId;
            $Item->gos_pres_concepto_id=$item->desc;
            $Item->gos_pres_servicio_id=$arrNOm[0];
            $Item->gos_servicio_taller_id=$arrNOm[1];
            $Item->gos_etapa_id=0;                   //Pendientes Etapas
            $Item->precio_servicio=$item->Pserv;
            $Item->precio_pintura=$item->Ppin;
            $Item->precio_refacciones=$item->Pref;
            $Item->nro_parte=$item->parte;
            $Item->observaciones=$item->obser;
            $Item->Save();
            $ID=$Item->gos_pres_item_id;
          }
      return($presId);
     }
    public function agregaItem(Request $request){
       $idpresupuest=Session::get('ppid');
       $Item= new Gos_Pres_Item();
       $Item->gos_pres_id=$idpresupuest;
       $Item->gos_pres_concepto_id=1;
       $Item->gos_pres_servicio_id=$request->gos_pres_servicio_id;
       $Item->gos_etapa_id=$request->gos_seccion_id;
       $Item->precio_servicio=$request->precio_servicio;
       $Item->precio_pintura=$request->precio_pintura;
       $Item->precio_refacciones=$request->precio_refacciones;
       $Item->Save();
       $ID=$Item->gos_pres_item_id;
       return("Item añadido");
    }
    public function VerPresupuesto($id){
         $subtotal=0;$iva=0;$descuento=0;$Dtipo="";$total=0;$motot=0;$momecanica=0;$TotalREf=0;$molaminado=0;$totalpin=0;
         $pres=Gos_Pres::find($id);
         $iva=$pres->iva;
         $descuento=$pres->descuento;
         $Dtipo=$pres->descuento_tipo;
         $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$pres->gos_taller_id)->get();
         $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
         $cliente=Gos_Cliente::find($pres->gos_cliente_id);
         $vehiculo=Gos_V_Vehiculos::where('gos_vehiculo_id',$pres->gos_vehiculo_id)->first();
         $vehi = explode("|",$vehiculo->vehiculo);
         $nomvehi=$vehi[1];
         foreach ($items as $item){
         $subtotal=$subtotal+$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones;
         $totalpin=$totalpin+$item->precio_pintura;
         if ($item->gos_servicio_taller_id=="T") {
            $motot=$motot+$item->precio_servicio;
         }
         if ($item->gos_servicio_taller_id=="M") {
            $momecanica=$momecanica+$item->precio_servicio;
         }
         if ($item->gos_servicio_taller_id=="L") {
            $molaminado=$molaminado+$item->precio_servicio;
         }
         }
         $civa=($iva*.01)+1;
         $cdescuento=($descuento*.01);
         if ($pres->descuento_tipo="porcentaje") {$total=($subtotal-($subtotal*$cdescuento))*$civa;}
         else{$total=($subtotal-$descuento)*$civa;}
         return view('/Presupuestos/VerPresupuesto')->with(compact('pres','items','cliente','nomvehi','subtotal','listaConceptos','total','iva','descuento','motot','momecanica','molaminado','TotalREf','totalpin'));
       }
    public function ImpPresupuesto($id){
      $subtotal=0;$iva=0;$descuento=0;$Dtipo="";$total=0;$Totrefacciones=0;$motot=0;$momecanica=0;$molaminado=0;$totalpin=0;$Aseg="";$nombrefile="Pesupuesto.pdf";
      $pres=Gos_Pres::find($id);
      $iva=$pres->iva;
      $descuento=$pres->descuento;
      $Dtipo=$pres->descuento_tipo;

      $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$pres->gos_taller_id)->get();
      $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      $cliente=Gos_Cliente::find($pres->gos_cliente_id);
      $vehiculo=Gos_V_Vehiculos::where('gos_vehiculo_id',$pres->gos_vehiculo_id)->first();
      $taller=Gos_Taller::find($pres->gos_taller_id);
      $os=GOS_V_OS::find($pres->gos_pres_os_id);
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      if($os!=null){
      $aseguradora=$os->nomb_aseguradora;
      $Aseg=explode("|",$aseguradora);
      $Aseg=$Aseg[0];
      $nombrefile=$os->nro_orden_interno.'Presupuesto.pdf';
      }else{$aseguradora="ND";}
      $vehi = explode("|",$vehiculo->vehiculo);
      $nomvehi=$vehi[1];
      $placa=$vehiculo->placa;
      foreach ($items as $item){

      $subtotal=$subtotal+$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones;
      $Totrefacciones=$Totrefacciones+$item->precio_refacciones;
       $totalpin=$totalpin+$item->precio_pintura;
      if ($item->gos_servicio_taller_id=="T") {
         $motot=$motot+$item->precio_servicio;
      }
      if ($item->gos_servicio_taller_id=="M") {
         $momecanica=$momecanica+$item->precio_servicio;
      }
      if ($item->gos_servicio_taller_id=="L") {
         $molaminado=$molaminado+$item->precio_servicio;
      }

      }
      $civa=($iva*.01)+1;
      $cdescuento=($descuento*.01);
      if ($pres->descuento_tipo="porcentaje") {$total=($subtotal-($subtotal*$cdescuento))*$civa;}
      else{$total=($subtotal-$descuento)*$civa;}
      if($taller->taller_lototipo!=null){$logo=public_path().Storage::url($taller->taller_lototipo);   }

      else{  $logo = public_path().'\img\logostalleres\logo.png';}

      $compact = array();
      $compact = compact('pres','items','cliente','nomvehi','subtotal','listaConceptos','total','iva','descuento','motot','momecanica','molaminado','Totrefacciones','placa','taller','logo','totalpin','os','Aseg','taller_conf_vehiculo','taller_conf_ase');
      //return view('/Presupuestos/pdf')->with(compact('pres','items','cliente','nomvehi','subtotal','listaConceptos','total','iva','descuento','TotalPintura','TotalMano'));
      return PDF::loadView('Presupuestos.pdf', $compact)->inline($nombrefile);
     }

     public function ImpPresupuestoHV($id)
     {$nombrefile="HojaViajera.pdf";
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $pres=Gos_Pres::find($id);
      $cliente=Gos_cliente::find($pres->gos_cliente_id);
      $vehiculo=Gos_Vehiculo::find($pres->gos_vehiculo_id);
      $vehiculoMod=Gos_Vehiculo_Modelo::find($vehiculo->gos_vehiculo_modelo_id);
      $vehiculoMarca=Gos_Vehiculo_Marca::find($vehiculoMod->gos_vehiculo_marca_id);
      $vehiculoColor=Gos_Color::where('codigohex',$vehiculo->color_vehiculo)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $os=Gos_V_OS::find($pres->gos_pres_os_id);
      if ($os!=null) {
          $nombrefile=$os->nro_orden_interno.'HojaViajera.pdf';
        $ossplit=explode('|', $os->nomb_aseguradora);
      }
      else{$ossplit=array("ND","ND","ND","ND","Poliza: ND","Poliza: ND","ND","ND","ND","ND","ND","ND","Daño: ND","Daño: ND","ND","Estatus: ND");}

      $itemsPrs=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      $conceptos=Gos_Pres_Concepto::all();

       $compact = array();
       $compact = compact('pres','cliente','vehiculo','vehiculoColor','vehiculoMod','vehiculoMarca','ossplit','conceptos','itemsPrs','os','taller_conf_vehiculo','taller_conf_ase');
      return PDF::loadView('Presupuestos.HVpdf', $compact)->inline($nombrefile);
     }
    public function MostrarEditarPresupuesto($id){
             $subtotal=0;
             $pres=Gos_Pres::find($id);
             $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
             $cliente=Gos_Cliente::find($pres->gos_cliente_id);
             $vehiculo=Gos_V_Vehiculos::where('gos_vehiculo_id',$pres->gos_vehiculo_id)->first();
             $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$pres->gos_taller_id)->get();
             $usuario=Session::get('usr_Data');
             $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
             $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
             $vehi = explode("|",$vehiculo->vehiculo);
             $nomvehi=$vehi[1];
             foreach ($items as $item){
             $subtotal=$subtotal+$item->precio_servicio+$item->precio_pintura+$item->precio_refacciones;
             }
         return view('/Presupuestos/EditarPresupuesto')->with(compact('pres','items','cliente','nomvehi','subtotal','listaConceptos','taller_conf_vehiculo','taller_conf_ase'));
    }
    public function EditarPresupuesto($id,Request $request){
             $items=json_decode($request->Jsnitems);
             $ELitems=json_decode($request->JsnELitems);
             $pres=Gos_Pres::find($id);$subtotal=0;
             $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
             if ($request->gos_os_id>0) {$pres->gos_pres_os_id=$request->gos_os_id;}
             $pres->gos_cliente_id=$request->gos_cliente_id_edit;
             $pres->gos_vehiculo_id=$request->gos_vehiculo_id;
             $pres->nro_poliza=$request->nro_poliza;
             $pres->nro_siniestro=$request->nro_siniestro;
             $pres->kilometraje=$request->kilometraje;
             $pres->fecha=$request->fecha_cotizacion;
             $pres->gos_pres_comentarios=$request->comentarios;
             $pres->iva=$request->Iva;
             $pres->save();
             $presId=$pres->gos_pres_id;
             $items=json_decode($request->Jsnitems);
             foreach ($items as $item){
              $Fitem=Gos_Pres_Item::find($item->id);
              if ($Fitem!=Null) {
                $Fitem->nro_parte=$item->parte;
                $Fitem->observaciones=$item->obser;
                $Fitem->Save();
              }
              else{
                $nomenclatura=$item->nomen;
                $arrNOm = str_split($nomenclatura);
                $Item= new Gos_Pres_Item();
                $Item->gos_pres_id=$presId;
                $Item->gos_pres_concepto_id=$item->desc;
                $Item->gos_pres_servicio_id=$arrNOm[0];
                $Item->gos_servicio_taller_id=$arrNOm[1];
                $Item->gos_etapa_id=0;                   //Pendientes Etapas
                $Item->precio_servicio=$item->Pserv;
                $Item->precio_pintura=$item->Ppin;
                $Item->precio_refacciones=$item->Pref;
                $Item->nro_parte=$item->parte;
                $Item->observaciones=$item->obser;
                $Item->Save();
               }
             }
              foreach ($ELitems as $El){
                    $Fitem=Gos_Pres_Item::find($El);
                    $Fitem->delete();
                  }
      }
    public function BorrarPresupuesto($id){
      $pres=Gos_Pres::find($id);
      $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      foreach ($items as $item) {
        $item->delete();
      }
        $pres->delete();
     return back();
    }
    public function UnirPresupuesto($presid){

      $vals=explode(",", $presid);
      $presid=$vals[0];
      $valuacionpres=$vals[1];
      if($valuacionpres==1){$valuacionpres=null;}

      $Totrefacciones=0;$motot=0;$momecanica=0;$molaminado=0;$totalpin=0;
      $hoy = date("Y-m-d H:i:s");
      $pres=Gos_Pres::find($presid);
      if($pres->gos_pres_estatus>0){return("Este presupuesto ya fue unido o  procesado id:".$pres->gos_pres_os_id);}
      else{
      $pres->gos_pres_estatus=1;
      $pres->valuacion=$valuacionpres;
      $pres->save();

      $tipoval = explode("V", $valuacionpres);
      $gos_os_id=$pres->gos_pres_os_id;
      $os=Gos_OS::find($gos_os_id);
      $fechaingreso=$os->fecha_ingreso_v_os;
      $date = strtotime($fechaingreso);
      $day = date('l', $date);


      if($valuacionpres!=null){
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
                // return($os->fecha_promesa_os);
                $os->save();
      }
      $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      //---------------------------LOOP INSERCION DE REFACCIONES---------------------------------------------------------------------------------------------------

      foreach ($items as $item) {
        if ($item->gos_pres_servicio_id=="C") {
        $refa= new Gos_Os_Refaccion();
        $refa->gos_os_id=$pres->gos_pres_os_id;;
        $refa->nombre=$item->gos_pres_concepto_id;
        $refa->nro_parte=$item->nro_parte;
        $refa->observaciones=$item->observaciones;
        $refa->gos_os_refaccion_estatus_id=1;
        $refa->fecha_solicitud=$hoy;
        $refa->gos_taller_id=$pres->gos_taller_id;
        $refa->save();
        }
      }


      //----------------------LOOP CALCULO PRESIOS LAMINADO MECANICA TOT
      foreach ($items as $calculoItem){
      $Totrefacciones=$Totrefacciones+$calculoItem->precio_refacciones;
       $totalpin=$totalpin+$calculoItem->precio_pintura;
      if ($calculoItem->gos_servicio_taller_id=="T") {$motot=$motot+$calculoItem->precio_servicio;}
      if ($calculoItem->gos_servicio_taller_id=="M") {$momecanica=$momecanica+$calculoItem->precio_servicio;}
      if($calculoItem->gos_servicio_taller_id=="L") {$molaminado=$molaminado+$calculoItem->precio_servicio;}
      }
      $molaminado=$molaminado+$motot;
      //-----------------------------INSERCION DE PRECIOS----------------------------------------------------
      $OSitems=Gos_V_Os_Items::where('gos_os_id',$pres->gos_pres_os_id)->get();
      foreach ($OSitems as $etapa) {
          if($etapa->servicio=="Laminado"){
            $INSITEM=Gos_Os_Item::find($etapa->gos_os_item_id);
            $INSITEM->importe_solicitado=$molaminado;
            $INSITEM->save();
          }
          if($etapa->servicio=="Mecanica"){
            $INSITEM=Gos_Os_Item::find($etapa->gos_os_item_id);
              $INSITEM->importe_solicitado=$momecanica;
                $INSITEM->save();
          }
          if($etapa->servicio=="Pintura"){
          $INSITEM=Gos_Os_Item::find($etapa->gos_os_item_id);
            $INSITEM->importe_solicitado=$totalpin;
              $INSITEM->save();
          }
        }


      return("Presupuesto Unido");
      }
    }
    public function ProcesarPresupuesto($id){
      $hoy = date("Y-m-d H:i:s");
      $pres=Gos_Pres::find($id);
      if($pres->gos_pres_estatus>0){return("Este presupuesto ya fue unido o  procesado id:".$pres->gos_pres_os_id);}
      else {
      $os= new Gos_OS();
      $os->gos_cliente_id=$pres->gos_cliente_id;
      $os->gos_taller_id=$pres->gos_taller_id;
      $os->gos_vehiculo_id=$pres->gos_vehiculo_id;
      $os->nro_siniestro=$pres->nro_siniestro;
      $os->nro_poliza=$pres->nro_poliza;
      $os->fecha_creacion_os=$hoy;
      $os->fecha_ingreso_v_os=$hoy;
      $os->gos_os_riesgo_id=1;
      $os->gos_os_tipo_o_id=1;
      $os->gos_os_tipo_danio_id=1;
      $os->gos_os_estado_exp_id=1;
      $os->save();
      $pres->gos_pres_os_id=$os->gos_os_id;
      $pres->gos_pres_estatus=2;
      $pres->save();
      $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      foreach ($items as $item) {
        if ($item->gos_pres_servicio_id=="C") {
          $refa= new Gos_Os_Refaccion();
          $refa->gos_os_id=$os->gos_os_id;
          $refa->nombre=$item->gos_pres_concepto_id;
          $refa->nro_parte=$item->nro_parte;
          $refa->observaciones=$item->observaciones;
          $refa->gos_os_refaccion_estatus_id=1;
          $refa->fecha_solicitud=$hoy;
          $refa->gos_taller_id=$pres->gos_taller_id;
          $refa->save();
        }
      }
      $response="Presupuesto Procesado OS generada id:".$os->gos_os_id;
      return($response);
      }
    }
    public function AgregaConcepto(Request $request){
      $idtaller=Session::get('taller_id');
      $concepto=new Gos_Pres_Concepto();
      $concepto->nomb_concepto=$request->name;
      $concepto->gos_taller_id=$idtaller;
      $concepto->save();
      $idcon=$concepto->gos_pres_concepto_id;
      return($idcon);
    }
    public function Dtclientesvehiculo(){
      $clientesVehiculos = Gos_V_Os::where('gos_taller_id',Session::get('taller_id'))->get();
      return $this->preparaDatosDataTable($clientesVehiculos, 1);
    }
    public function carpetas($status){
      $idtaller=Session::get('taller_id');
      $todos=Gos_Pres::where('gos_taller_id',$idtaller)->count();
      $prendientes=Gos_Pres::where('gos_pres_estatus',0)->where('gos_taller_id',$idtaller)->count();
      $unidos=Gos_Pres::where('gos_pres_estatus',1)->where('gos_taller_id',$idtaller)->count();
      $procesados=Gos_Pres::where('gos_pres_estatus',2)->where('gos_taller_id',$idtaller)->count();
      $listaOrdenes=Gos_V_Os::where('gos_taller_id',$idtaller)->get();
      $listaPress=Gos_V_Pres::where('gos_taller_id',$idtaller)->where('gos_pres_estatus',$status)->get();
      $gos_v_press =  Gos_V_Pres::where('gos_taller_id',$idtaller)->get();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $ajax = $this->preparaDataTableAjax($listaPress, $this->getOpcionesEditDataTable());
      if (null !== $ajax) {
          return $ajax;
      }
      $compact = compact('prendientes','procesados','unidos','todos','listaOrdenes','gos_v_press','taller_conf_vehiculo','taller_conf_ase');
      return view('Presupuestos/ListarPresupuestos', $compact);
    }
    public function OSpresupuestoagregaredt(Request $request){
      $OS=Gos_Os::find($request->Osid);
      $pres=Gos_Pres::where('gos_pres_os_id',$request->Osid)->first();
      if($pres!=null)
      {
        $items=json_decode($request->Jsnitems);
        $ELitems=json_decode($request->JsnELitems);
        $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
        $pres->gos_cliente_id=$OS->gos_cliente_id;
        $pres->gos_vehiculo_id=$OS->gos_vehiculo_id;
        $pres->nro_poliza=$OS->nro_poliza;
        $pres->nro_siniestro=$OS->nro_siniestro;
        $pres->iva=$request->Iva;
        $pres->fecha=$request->fecha_cotizacion;
        $pres->gos_pres_comentarios=$request->comentarios;
        $pres->valuacion=$request->valuacion;
        $pres->save();
        $presId=$pres->gos_pres_id;
        $items=json_decode($request->Jsnitems);
        foreach ($items as $item){
         $Fitem=Gos_Pres_Item::find($item->id);
         if ($Fitem!=Null) {
           $Fitem->nro_parte=$item->parte;
           $Fitem->observaciones=$item->obser;
           $Fitem->Save();
         }
         else{
           $nomenclatura=$item->nomen;
           $arrNOm = str_split($nomenclatura);
           $Item= new Gos_Pres_Item();
           $Item->gos_pres_id=$presId;
           $Item->gos_pres_concepto_id=$item->desc;
           $Item->gos_pres_servicio_id=$arrNOm[0];
           $Item->gos_servicio_taller_id=$arrNOm[1];
           $Item->gos_etapa_id=0;                   //Pendientes Etapas
           $Item->precio_servicio=$item->Pserv;
           $Item->precio_pintura=$item->Ppin;
           $Item->precio_refacciones=$item->Pref;
           $Item->nro_parte=$item->parte;
           $Item->observaciones=$item->obser;
           $Item->Save();
          }
        }
        foreach ($ELitems as $El){
          if ($El!=null) {
            $Fitem=Gos_Pres_Item::find($El);
            $Fitem->delete();
                }
            }
      }

      else{
        $hoy = date('Y-m-d H:i:s');
        $pres= new Gos_Pres();
        $items=json_decode($request->Jsnitems);
        $pres->gos_taller_id=Session::get('usr_Data.gos_taller_id');
        $pres->gos_cliente_id=$OS->gos_cliente_id;
        $pres->gos_vehiculo_id=$OS->gos_vehiculo_id;
        $pres->nro_poliza=$OS->nro_poliza;
        $pres->nro_siniestro=$OS->nro_siniestro;
        $pres->iva=$request->Iva;
        if ($request->fecha_cotizacion!=null) {  $pres->fecha=$request->fecha_cotizacion;}
        if ($request->fecha_cotizacion==null)  {  $pres->fecha=$hoy;}
        $pres->gos_pres_comentarios=$request->comentarios;
        $pres->gos_pres_os_id=$request->Osid;
        $pres->valuacion=$request->valuacion;
        $pres->save();
        $presId=$pres->gos_pres_id;
        foreach ($items as $item) {
          $nomenclatura=$item->nomen;
          $arrNOm = str_split($nomenclatura);
          $Item= new Gos_Pres_Item();
          $Item->gos_pres_id=$presId;
          $Item->gos_pres_concepto_id=$item->desc;
          $Item->gos_pres_servicio_id=$arrNOm[0];
          $Item->gos_servicio_taller_id=$arrNOm[1];
          $Item->gos_etapa_id=0;                   //Pendientes Etapas
          $Item->precio_servicio=$item->Pserv;
          $Item->precio_pintura=$item->Ppin;
          $Item->precio_refacciones=$item->Pref;
          $Item->nro_parte=$item->parte;
          $Item->observaciones=$item->obser;
          $Item->Save();
          $ID=$Item->gos_pres_item_id;
        }
      }
      return ($request);
    }

public function CrearYUnirPresupuesto(Request $request){
  $valuacionpres = $request->valuacion;
  $OS=Gos_Os::find($request->Osid);
  $hoy = date('Y-m-d H:i:s');
  $pres= new Gos_Pres();
  $items=json_decode($request->Jsnitems);
  $pres->gos_taller_id=Session::get('usr_Data.gos_taller_id');
  $pres->gos_cliente_id=$OS->gos_cliente_id;
  $pres->gos_vehiculo_id=$OS->gos_vehiculo_id;
  $pres->nro_poliza=$OS->nro_poliza;
  $pres->nro_siniestro=$OS->nro_siniestro;
  $pres->iva=$request->Iva;
  if ($request->fecha_cotizacion!=null) {  $pres->fecha=$request->fecha_cotizacion;}
  if ($request->fecha_cotizacion==null)  {  $pres->fecha=$hoy;}
  $pres->gos_pres_comentarios=$request->comentarios;
  $pres->gos_pres_os_id=$request->Osid;
  if($valuacionpres==1){$valuacionpres=null;}
  $pres->valuacion=$valuacionpres;
  $pres->save();
  $presId=$pres->gos_pres_id;
  foreach ($items as $item) {
    $nomenclatura=$item->nomen;
    $arrNOm = str_split($nomenclatura);
    $Item= new Gos_Pres_Item();
    $Item->gos_pres_id=$presId;
    $Item->gos_pres_concepto_id=$item->desc;
    $Item->gos_pres_servicio_id=$arrNOm[0];
    $Item->gos_servicio_taller_id=$arrNOm[1];
    $Item->gos_etapa_id=0;                   //Pendientes Etapas
    $Item->precio_servicio=$item->Pserv;
    $Item->precio_pintura=$item->Ppin;
    $Item->precio_refacciones=$item->Pref;
    $Item->nro_parte=$item->parte;
    $Item->observaciones=$item->obser;
    $Item->Save();
    $ID=$Item->gos_pres_item_id;
  }
  $valuacion = $request->valuacion;
  $array= $presId. "," . $valuacion;
  $response=$this->UnirPresupuesto($array);
  return($response);
}


//_____________________________________________________________________________QUALITAS METHODS SECTION BEGIN______________________________________________________________________________________










//_____________________________________________________________________________QUALITAS METHODS SECTION END______________________________________________________________________________________
}
