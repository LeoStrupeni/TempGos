<?php

namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use session;
use App\Gos\Gos_Taller;
use App\Gos\Gos_Taller_Numero_Prov_Qualitas;
use App\Gos\Qualitas_Wsreportes;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Color;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_OS;
use App\Gos\Gos_Vehiculo_Inventario;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Inventario_Parte;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_Paquete_Item;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_Producto;
use App\Gos\Gos_Pres;
use App\Gos\Gos_Pres_Concepto;
use App\Gos\Gos_Pres_Item;
use App\Gos\Qualitas_Repositorio_Archivos;
use App\Gos\Gos_Os_Imagen_Interna;
use Illuminate\Support\Facades\Storage;

class QualitasController extends Controller
{
  public function asignadoqualitas(){
    $casignados=0; $Ctransito=0; $Cpiso=0; $Cterm=0;  $Centregadas=0; $CFactu=0; $Cperpago=0; $Chistorico=0;
    $cadCt="";
    $idtaller=Session::get('taller_id');
    $codigosT=Gos_Taller_Numero_Prov_Qualitas::where('gos_taller_id', $idtaller)->get();
    $listaMarcas=Gos_Vehiculo_Marca::where('gos_taller_id', $idtaller)->get();
    $coloresVehiculo= Gos_Color::where('gos_taller_id',0)->orwhere('gos_taller_id', $idtaller)->get();
    foreach ($codigosT as $ct) {
     $cadCt=$cadCt.$ct->codigo_prov.",";
    }
    $ArCT=explode(",",$cadCt);
    $wsreportes=Qualitas_Wsreportes::wherein('clavetaller',$ArCT)->orderBy('created_at','desc')->groupby('expediente_id')->get();
     foreach ($wsreportes as $reporte) {
       if ($reporte->estatus==0) {
        $casignados=$casignados+1;
       }
     }
    $asequl=Gos_Aseguradora::where('gos_taller_id',$idtaller)->where('empresa','like','%ali%')->first();
    $os=Gos_V_Os::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$asequl->gos_aseguradora_id)->get();
    foreach ($os as $orden) {
      if ($orden->gos_os_estado_exp_id==2 && $orden->fecha_terminado==null ) {$Ctransito=$Ctransito+1;}
      if ($orden->gos_os_estado_exp_id==1 && $orden->fecha_terminado==null ) {$Cpiso=$Cpiso+1;}
      if ( $orden->fecha_terminado!=null &&  $orden->fecha_entregado==null ) {$Cterm=$Cterm+1;}
      if ($orden->fecha_entregado!=null &&  $orden->fecha_facturado==null) {$Centregadas=$Centregadas+1;}
      if ( $orden->fecha_facturado!=null) {$CFactu=$CFactu+1;}
      if ($orden->gos_os_tipo_o==4 || $orden->gos_os_tipo_o==5 ) {if ($orden->fecha_terminado==null){$Cperpago=$Cperpago+1;}}
    }
    return view('Qualitas/ListarOsAsignadas')->with(compact('wsreportes','listaMarcas','coloresVehiculo','os','casignados','Ctransito','Cpiso','Cterm','Centregadas','CFactu','Cperpago'));
  }

  public function agregarordenqualitas(){
    return view('Qualitas/AgregarOSQualitas');
  }

  public function asigget(Request $request){
       $idtaller=Session::get('taller_id');
       $cliente= new Gos_Cliente;
       $cliente->gos_taller_id=$idtaller;
       $cliente->nombre=$request->nombre;
       $cliente->apellidos=$request->apellidos;
       $cliente->celular=$request->celular;
       $cliente->email_cliente=$request->email_cliente;
       $cliente->save();
       $idcl=$cliente->gos_cliente_id;
       $vehiculo= new Gos_Vehiculo();
       $vehiculo->gos_vehiculo_marca_id=$request->gos_vehiculo_marca_id;
       $vehiculo->gos_vehiculo_modelo_id=$request->gos_vehiculo_modelo_id;
       $vehiculo->anio_vehiculo=$request->anio_vehiculo;
       $vehiculo->color_vehiculo=$request->color_vehiculo;
       $vehiculo->placa=$request->placa;
       $vehiculo->economico=$request->economico;
       $vehiculo->nro_serie=$request->nro_serie;
        $vehiculo->gos_cliente_id=$idcl;
       $vehiculo->save();
       $idvehi=$vehiculo->gos_vehiculo_id;
       //_________________AGREGAROS
       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $randomString = '';
       for ($i = 0; $i < 10; $i++) {
         $index = rand(0, strlen($characters) - 1);
         $randomString .= $characters[$index];
       }
       $tokenseguimiento=$randomString;
       $ligaTokenseguimiento='/LigaSeguimiento/'.$randomString;
    //___________________________________________creacion de token_______________________________
       $ase= Gos_Aseguradora::where('gos_taller_id',$idtaller)->where('empresa','like','%lit%')->first();
       $hoy = date("Y-m-d H:i:s");
       $usr=Session::get('usr_Data');
       $valOS=Gos_OS::where('gos_taller_id',$idtaller)->get();
       $max = sizeof($valOS);
      if ($max!=0) {
        $latestID=DB::select( DB::raw('select nro_orden_interno as lastid from gos_os where gos_taller_id='.$idtaller.' ORDER BY gos_os_id DESC limit 1;'));
        $UltimaOrder=$latestID[0]->lastid;
        if ($UltimaOrder<1) { $UltimaOrder=1;}
        else {$UltimaOrder=$UltimaOrder+1;}
      }
      else{$UltimaOrder=1;}
      $wsreporte=Qualitas_Wsreportes::find($request->wereportid);
           $OS=new Gos_OS();
           $OS->gos_cliente_id=$idcl;
           $OS->gos_taller_id=$idtaller;
           $OS->gos_aseguradora_id=$ase->gos_aseguradora_id;
           $OS->nro_reporte=$wsreporte->num_reporte;
           $OS->nro_siniestro=$wsreporte->num_siniestro;
           $OS->nro_orden_interno=$UltimaOrder;
           $OS->nro_poliza=$wsreporte->poliza;
           $OS->gos_os_riesgo_id=1;
           $OS->gos_os_tipo_o_id=1;
           $OS->gos_os_tipo_danio_id=1;
           $OS->gos_os_estado_exp_id=1;
           $OS->gos_vehiculo_id=$idvehi;
           $OS->gos_ot_id=0;
           $OS->fecha_creacion_os=$hoy;
           $OS->fecha_ingreso_v_os=0;
           $OS->fecha_promesa_os=0;
           $OS->gos_os_token_seguimiento=$tokenseguimiento;
           $OS->gos_os_liga_seguimiento=$ligaTokenseguimiento;
           $OS->gos_usuario_id=$usr->gos_usuario_id;
           $OS->save();
           $IDOSAC=$OS->gos_os_id;
           $wsreporte->estatus=1;
           $wsreporte->gos_os_id=$IDOSAC;
           $wsreporte->save();
           $wsreportesall=Qualitas_Wsreportes::where('num_reporte',$OS->nro_reporte)->get();

         //_________________________________________Inventario____________________________________________
         $Invent= new Gos_Vehiculo_Inventario();
           $Invent->gos_os_id=$IDOSAC;
           $Invent->gos_vehiculo_id=$idvehi;
           $Invent->gos_vehiculo_medidor_gas_id=9;
           $Invent->save();
           $idINV=$Invent->gos_vehiculo_inventario_id;
           $partesRef=Gos_Vehiculo_Parte::all();
                foreach ($partesRef as $partederef ){
                  $parte= new Gos_Vehiculo_Inventario_Parte();
                  $parte->gos_vehiculo_inventario_id=$idINV;
                  $parte->gos_vehiculo_parte_id=$partederef->gos_vehiculo_parte_id;
                  $parte->save();
                }

         $VOS=Gos_V_Os::where('gos_os_id',$IDOSAC)->first();
         $listaPaquetes = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->get();
         $listaTipoOrden = Gos_OS_Tipo_O::all();
         $listaDanios = Gos_OS_Tipo_Danio::all();
         $listaEstadosExp = Gos_OS_Estado_Exp::all();
        return view('Qualitas/AgregarOSQualitas')->with(compact('OS','cliente','vehiculo','VOS','listaPaquetes','listaTipoOrden','listaDanios','listaEstadosExp','hoy'));;
  }

  public function finalizarOS(Request $request)
  {
         $idtaller=Session::get('taller_id');
         $OS=Gos_OS::find($request->OSID);
         $OS->gos_os_tipo_o_id=$request->gos_os_tipo_o_id;
         $OS->gos_os_tipo_danio_id=$request->gos_os_tipo_danio_id;
         $OS->gos_os_estado_exp_id=$request->gos_os_estado_exp_id;
         $OS->con_especiales=$request->condesp;
         $OS->ing_grua=$request->IGrua;
         $OS->fecha_creacion_os=$request->fecha_creacion_os;
         $OS->fecha_ingreso_v_os=$request->fecha_ingreso_v_os;
         $OS->fecha_promesa_os=$request->fecha_promesa;
         $OS->save();
         $wsreporte=Qualitas_Wsreportes::where('gos_os_id',$OS->gos_os_id)->first();
         $wsreporte->estatus=$request->gos_os_estado_exp_id;
         $wsreporte->save();
         //ITEMS_____________________________________________________________
         $flagavtivateetapa=0; $orden=1;
         $hoy = date("Y-m-d H:i:s");
         $cadPaquete=$request->paquetesCadid;
         $Paquetes=explode(",",$cadPaquete);
         $estado_etapaAct="A";
         $PaqItemRef=Gos_Paquete_Item::whereIn('gos_paquete_item_id',$Paquetes)->orderBy('orden_etapa', 'ASC')->get();

         foreach ($PaqItemRef as $ItemRef) {
           $OSITM= new Gos_Os_Item();
           $OSITM->gos_os_id=$request->OSID;
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
           //______________________________llamado A metodos WS_____________________________________
           $hoyQlt = date("Y-m-d");
           $cliente=Gos_Cliente::find($OS->gos_cliente_id);
           $vehiculo=Gos_Vehiculo::find($OS->gos_vehiculo_id);
           $responsefecha=$this->SoapEnviaFechaIngreso($hoyQlt,$wsreporte->expediente_id);
           if ($request->gos_os_estado_exp_id==1) {
             $Pisotran=0;
           }
           if ($request->gos_os_estado_exp_id==2) {
             $Pisotran=1;
           }
           $responsecontacto=$this->SoapEnviaContacto($cliente->apellidos,$cliente->celular,$cliente->email_cliente,$request->IGrua,$wsreporte->expediente_id,$cliente->nombre,$request->gos_os_estado_exp_id,$vehiculo->placa,$vehiculo->nro_serie,$cliente->telefono_fijo);

           //____________________________________
         }
        return redirect('/orden-servicio-generada/'.$request->OSID);
  }

 //______________________PRESUPUESTOS QUALITAS____________________________________
  public function AgregarPresQualitasGET($OSID){
    $hoy = date("Y-m-d H:i:s");
    $idtaller=Session::get('taller_id');
    $listaProductos=Gos_Producto::where('gos_taller_id',$idtaller)->get();
    $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$idtaller)->get();
    $listaImgInternas=Gos_Os_Imagen_Interna::where('gos_os_id', $OSID)->get();
    $pres= Gos_Pres::where('gos_taller_id',$idtaller)->where('gos_pres_os_id',$OSID)->first();
    $OS=Gos_V_Os::where('gos_taller_id',$idtaller)->where('gos_os_id',$OSID)->first();
    if($pres!=null){
        $itempres=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
      return view('Qualitas/EditarPresQualitas')->with(compact('listaProductos','listaConceptos','hoy','OS','pres','itempres','listaImgInternas'));
    }
    else{
      return view('Qualitas/AgregarPresQualitas')->with(compact('listaProductos','listaConceptos','hoy','OS'));
       }
    }

  public function AgregarPresQualitasPost($OSID,Request $request){
         $hoy = date("Y-m-d H:i:s");
         $idtaller=Session::get('taller_id');
         $OS=Gos_V_Os::where('gos_taller_id',$idtaller)->where('gos_os_id',$OSID)->first();
         $items=json_decode($request->Jsnitems);
         $pres= new Gos_Pres();
         $pres->gos_pres_os_id=$OS->gos_os_id;
         $pres->gos_cliente_id=$OS->gos_cliente_id;
         $pres->gos_taller_id=$idtaller;
         $pres->fecha=$hoy;
         $pres->gos_vehiculo_id=$OS->gos_vehiculo_id;
         $pres->nro_poliza=$OS->nro_poliza;
         $pres->nro_siniestro=$OS->nro_siniestro;
         $pres->kilometraje=0;
         $pres->iva=$request->Iva;
         $pres->descuento_tipo=$request->descuento_tipo;
         $pres->descuento=$request->Descuento;
        // $pres->valuacion=$request->valuacion;
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
  }

  public function EditarPresQualitasPost($OSID,Request $request){
         $idtaller=Session::get('taller_id');
         $items=json_decode($request->Jsnitems);
         $ELitems=json_decode($request->JsnELitems);
         $pres=Gos_Pres::where('gos_pres_os_id',$OSID)->first();
         $OS=Gos_V_Os::where('gos_taller_id',$idtaller)->where('gos_os_id',$OSID)->first();
         $items=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id)->get();
         if ($request->gos_os_id>0) {$pres->gos_pres_os_id=$request->gos_os_id;}
         $pres->gos_cliente_id=$OS->gos_cliente_id;
         $pres->gos_vehiculo_id=$OS->gos_vehiculo_id;
         $pres->nro_poliza=$OS->nro_poliza;
         $pres->nro_siniestro=$OS->nro_siniestro;
        // $pres->valuacion=$request->valuacion;
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

  public function WSEnviarValuacion($OSID , $val){
     $cambio=0;   $molaminado=0; $momecanica=0; $dias=3;//v0=4dias v1=7dias v2=14dias v3=28 dias v4=45dias;
     $os=Gos_OS::find($OSID);
     $wsreporte=Qualitas_Wsreportes::where('gos_os_id',$OSID)->first();
     $pres=Gos_Pres::where('gos_pres_os_id',$OSID)->first();
     $presitems=Gos_Pres_Item::where('gos_pres_id',$pres->gos_pres_id);
     foreach ($presitems as $item) {
      if ($item->gos_pres_servicio_id=="C"){$cambio=$cambio+1;}
      if ($item->gos_servicio_taller_id=="M") {
         $momecanica=$momecanica+$item->precio_servicio;
      }
      if ($item->gos_servicio_taller_id=="L") {
         $molaminado=$molaminado+$item->precio_servicio;
      }
     }
     if ($cambio=0) {$dias=4;}
     if ($cambio>=1) {$dias=7;}
     if ($cambio>=4) {$dias=14;}
     if ($cambio>=11) {$dias=28;}
     if ($cambio>=24) {$dias=45;}
     $precio=$molaminado+$momecanica;
     $response=$this->SoapenviarValuador($dias,$wsreporte->expediente_id,$precio,$cambio);
       //dd($response->enviarValuadorReturn);
     return($response->enviarValuadorReturn);
  }
//_____________________________________ORDEN DE SERVICIO GENERADA QUALITAS____________________________________

 public function SubirFiles($osid,Request $request){
      $listfile= array();
     $idtaller=Session::get('taller_id');
    $os=Gos_OS::find($osid);
    $wsreporte=Qualitas_Wsreportes::where('gos_os_id',$osid)->first();
    foreach ($request->archivosQlt as $archive ){
    if ($request->hasFile('archivosQlt')) {
          $file=new Qualitas_Repositorio_Archivos();
          //$file->idexpediente=$wsreporte->expediente_id;
          $archivefile = base64_encode(file_get_contents($archive));
          $file->bytestring=$archivefile;
          $name=$archive->getClientOriginalName();
          $arname=explode(".",$name);
          $file->nombre=$arname[0];
          $file->formato=$arname[1];
          $file->tipo=$request->tipofileqlt;
          $file->gos_os_id=$osid;
          $file->carpeta=$request->carpetaqlts;
          $file->documentourl="RepQualitas/".$idtaller."/".$name;
          $file->save();
          Storage::disk('public')->put("RepQualitas/".$idtaller."/".$name, base64_decode($file->bytestring));
         //  $WSfile = (object) ['byteString' => $file->bytestring,'formato' =>  $file->formato,'nombre' => $file->nombre,'tipo' => $file->tipo, ];
         $response=$this->SoapEnviarImagenInt($wsreporte->expediente_id, $file->tipo, $file->bytestring,$file->formato,  $file->nombre);
         }
      }
    return back();
   }



//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//----------------------------------------------------------------------SECCION PARA CONSUMIR LOS WEB SERVICES BEGIN--------------------------------------------------------------------------------------------|
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|

//__________________GET REPORTE CONSUME WSCONSULTAPRO getReporte______________________________________________________________________________________________________________________________________________|

   public function WSgetReporte(Request $request){
     $cadresp="";  $hoy = date("Y-m-d H:i:s");
     $ejercicioin=$request->ejercicio;
     $reportein=$request->Reporte;
    $idtaller=Session::get('taller_id');
    $coddsTaller=Gos_Taller_Numero_Prov_Qualitas::where('gos_taller_id',$idtaller)->get();
       foreach ($coddsTaller as $codT) {
       $response=$this->ConsumirSoapgetReporte($ejercicioin,$reportein,$codT->codigo_prov); //call al metodo que consulta
      // $response=$this->ConsumirSoapgetReporte('19','0000010','01721');
       $reportemsg=$response->getReporteReturn->ejercicio;
       $len=strlen($reportemsg);
      if ($len>8) {
          $cadresp=" ".$cadresp.$reportemsg." - ";
          }
          else {
          $reporteresponse=$response->getReporteReturn;
          $insertarrep=Qualitas_Wsreportes::where('num_reporte',$reportein)->first(); //si existe actualiza
          if ($insertarrep==null) {$insertarrep= new Qualitas_Wsreportes();}   //else crea
          $insertarrep->expediente_id=$reporteresponse->idExpediente;
          $insertarrep->ejercicio=$reporteresponse->ejercicio;
          $insertarrep->num_reporte=$reporteresponse->numReporte;
          $insertarrep->riesgo=$reporteresponse->tipoRiesgo;
          $insertarrep->poliza=$reporteresponse->poliza;
          $insertarrep->idmarca=$reporteresponse->idMarca;
          $insertarrep->marca=$reporteresponse->marcaDescripcion;
          $insertarrep->modelo=$reporteresponse->modelo;
          $insertarrep->tipo=$reporteresponse->tipo;
          $insertarrep->serie=$reporteresponse->serie;
          $insertarrep->placa=$reporteresponse->placa;
          $insertarrep->clavetaller=$reporteresponse->claveTaller;
          $insertarrep->estatus=0;
          $insertarrep->created_at=$hoy;
          $insertarrep->updated_at=$hoy;
          $insertarrep->save();
          $cadresp=$cadresp." Numero De Reporte Añadido ".$reportein;
          }
     }
       return redirect()->back()->with('notification', $cadresp);
   }

   public function ConsumirSoapgetReporte($ejercicio,$reporte,$codtaller){
     $consulta = [
           'ejercicio' => $ejercicio,
           'numReporte' => $reporte,
           'claveTaller' => $codtaller,
            'user' =>[
             'pass' => '123',
             'usuario' => 'ProOrder',
            ]];
     $wsdl = 'http://207.248.252.225/wsConsultaPro/services/ConsultaWsService?wsdl';
     $cliente = new \SoapClient($wsdl, [
          'codProveedor'=>"codProveedor",
           'correo'=>"correo",
           'estatus'=>"estatus",
           'nombre'=>"nombre",
          ]);
     $resultado = $cliente->getReporte($consulta);
     return($resultado);
   }
  //_______________________________Enviar Contacto______________________________________________________________________________________________________________________________________________________________|
    public function SoapEnviaContacto($apellido,$celular,$correo,$grua,$idExpediente,$nombre,$pisoTransito,$placa,$serie,$telFijo){
      $consulta = ['contacto' =>[
              'apellido' => $apellido,
              'celular' => $celular,
              'correo' => $correo,
              'grua' => $grua,
              'idExpediente' => $idExpediente,
              'nombre' => $nombre,
              'pisoTransito' => $pisoTransito,
              'placa' => $placa,
              'serie' => $serie,
              'telFijo' => $telFijo,
               ],
               'user' =>[
                'pass' => '123',
                'usuario' => 'ProOrder',
               ]];
        $wsdl = 'http://207.248.252.225/wsActualizaPro/services/WsActualizaSoap?wsdl';
        $cliente = new \SoapClient($wsdl, [
             'enviarContactoReturn'=>"enviarContactoReturn",
             ]);
        $resultado = $cliente->enviarContacto($consulta);
        return($resultado);
    }
  //_______________________________Enviar Fecha Ingreso_________________________________________________________________________________________________________________________________________________________|
    public function SoapEnviaFechaIngreso($fecIngreso,$idExpediente){
        $consulta = ['ingreso' =>[
                'fecIngreso' => $fecIngreso,
                'idExpediente' => $idExpediente,
                 ],
                 'user' =>[
                  'pass' => '123',
                  'usuario' => 'ProOrder',
                 ]];
          $wsdl = 'http://207.248.252.225/wsActualizaPro/services/WsActualizaSoap?wsdl';
          $cliente = new \SoapClient($wsdl, [
               'enviarFecIngresoReturn'=>"enviarFecIngresoReturn",
               ]);
          $resultado = $cliente->enviarFecIngreso($consulta);
          return($resultado);
      }
  //_______________________________________ENVIAR IMAGEN________________________________________________________________________________________________________________________________________________________|
   public function SoapEnviarImagenInt($idexp,$tipo,$byteString,$formato,$nombre){
     $consulta = ['idExpediente' =>$idexp,
                     'tipo' =>$tipo,
                    'listFile' =>[
                      'byteString' => $byteString,
                      'formato' => $formato,
                      'nombre' => $nombre,
                      'tipo' => $tipo,
                    ],
              'user' =>[
               'pass' => '123',
               'usuario' => 'ProOrder',
              ]];
       $wsdl = 'http://207.248.252.225/wsFotosPro/services/WsFotosSoap?wsdl';
       $cliente = new \SoapClient($wsdl, [
            'enviarImagenResponse'=>"enviarImagenResponse",
              'enviarImagenReturn'=>"enviarImagenReturn"
            ]);
       $resultado = $cliente->enviarImagen($consulta);
       dd($resultado);
   }

   //_____________________________________ENVIAR VALUADOR_______________________________________________________________________________________________________________________________________________________|
  public function SoapenviarValuador($diasReparacion,$idExpediente,$presupuestoMob,$totalPiezas){
    $consulta = ['valuar' =>[
                  'diasReparacion' => $diasReparacion,
                  'idExpediente' => $idExpediente,
                  'presupuestoMob' => $presupuestoMob,
                  'totalPiezas' => $totalPiezas,
             ],
             'user' =>[
                'pass' => '123',
                'usuario' => 'ProOrder',
             ]];
      $wsdl = 'http://207.248.252.225/wsActualizaPro/services/WsActualizaSoap?wsdl';
      $cliente = new \SoapClient($wsdl, [
           'enviarValuador'=>"enviarValuador",
           ]);
      $resultado = $cliente->enviarValuador($consulta);
      return($resultado);
  }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//------------------------------------------------------------------------SECCION PARA CONSUMIR LOS WEB SERVICES END--------------------------------------------------------------------------------------------|
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|


  //___________________METODOS PRUEBA__________________


}//CLASS END __________
