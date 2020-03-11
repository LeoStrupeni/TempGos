<?php

namespace App\Http\Controllers\Gos\OS;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Gos\GosControllers;


use App\Gos\Gos_OS;
use App\Gos\Gos_Os_Refaccion;
use App\Gos\Gos_V_Os_Refaccion;
use App\Gos\Gos_OS_Refaccion_Estatus;
use App\Gos\Gos_Os_Refaccion_Comentarios;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_Proveedor;
use App\Gos\Gos_Producto_Ubicacion;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_Vehiculo_Modelo;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Color;
use App\Gos\Gos_Os_Mensajes;
use App\Gos\Gos_Taller;
use App\Gos\Gos_V_Usuarios;
use App\Gos\Gos_Pres_Concepto;
use session;
use PDF;
class RefaccionesOSController extends GosControllers
{


    public function indexplano($osid){
      $fechahoy = date("Y-m-d");
      $idtaller=Session::get('taller_id');
      $user=Session::get('usr_Data');
      $os=Gos_OS::find($osid);
      $equipodetrabajo=Gos_V_Usuarios::where('gos_taller_id',$idtaller)->get();
      $listarefacciones = Gos_OS_Refaccion::where('gos_os_id', $osid)->get();
      $listaProveedor=Gos_Proveedor::where('gos_taller_id', $idtaller)->get();
      $listaConceptos=Gos_Pres_Concepto::where('gos_taller_id',$idtaller)->get();
      $listaubicaiones=Gos_Producto_Ubicacion::where('gos_taller_id',$idtaller)->get();
      $refacciones= Gos_V_OS_Refaccion::where('gos_os_id',$osid)->get();
      $cadprovref="";
      foreach ($refacciones as $ref) {
      $cadprovref=$cadprovref.",".$ref->proveedor;
      }
      $inprov=explode(",",$cadprovref);
      $listaprovconrefac=Gos_Proveedor::where('gos_taller_id', $idtaller)->wherein('gos_proveedor_id',$inprov)->get();
      $comentariosrefaccion=DB::select( DB::raw('select *from (SELECT * FROM gos_os_mensaje where gos_os_id='.$osid.' and de="ref" AND (gos_usuario_envio = '.$user->gos_usuario_id.' or gos_usuario_id = '.$user->gos_usuario_id.'  or gos_usuario_envio = 0)) AS F GROUP BY cuerpo'));
      $estatusrefaccionescanceladas=Gos_Os_Refaccion_Estatus::where('estatus_refaccion','like','%Cancelado%')->get();
     return view('/OS/Refacciones/RefaccionesPlano')->with(compact('listarefacciones','listaProveedor','os','fechahoy','listaConceptos','listaprovconrefac','equipodetrabajo','comentariosrefaccion','estatusrefaccionescanceladas','refacciones'));
    }





    public function show($id)
    {
      $idtaller=Session::get('taller_id');
      $Listarefacciones = Gos_OS_Refaccion::where('gos_os_id', $id)->get();
      $Refacciones_estatus = Gos_OS_Refaccion_Estatus::find($Listarefacciones->gos_os_refacciones_estatus_id);
      $listaProveedor=Gos_Proveedor::where('gos_taller_id', $idtaller)->get();
      $ajax = $this->preparaDataTableAjax($Listarefacciones, $this->getOpcionesEditDataTable());
      if (null !== $ajax) { return $ajax;}
     return view('/OS/Refacciones/Refacciones')->with(compact('Listarefacciones','Listarefacciones_estatus','listaProveedor'));
    }

    public function AgregarRefaccion()
    {
        $idtaller=Session::get('taller_id');
        $listaProductos=Gos_Producto::where('gos_taller_id', $idtaller)->get();
        return view('/Presupuestos/AgregarPresupuesto')->with(compact('listaProductos', 'listaConceptos', 'hoy'));
    }

    public function store(Request $request)
    {
        $items=json_decode($request->Jsnitems);
        $refacciones= new Gos_OS_Refaccion();
        $refacciones->gos_os_id=$request->gos_os_id;
        $refacciones->nomb_refaccion=$request->nomb_refaccion;
        $refacciones->proveedor=$request->proveedor;
        $refacciones->proveedor_email=$request->proveedor_email;
        $refacciones->fecha_asignado=$request->fecha_asignado;
        $refacciones->fecha_promesa=$request->fecha_promesa;
        $refaciones->gos_os_refaccion_estatus_id;
        $refacciones->save();
        return("Refacción añadida");
    }
//----------------------------------------------

  public function getprovedoresrefacciones($id)
  {
      $Proveedor=Gos_Proveedor::where('gos_proveedor_id', $id)->get();
      return($Proveedor);
  }
  public function Provedoresesref()
  {
    $idtaller=Session::get('taller_id');
    $Proveedores=Gos_Proveedor::where('gos_taller_id', $idtaller)->get();
    return($Proveedores);
  }

  public function Ubicacionesref()
  {
   $idtaller=Session::get('taller_id');
   $ubicaciones=Gos_Producto_Ubicacion::where('gos_taller_id',$idtaller)->get();
   return($ubicaciones);
  }

  public function getrefaccion($id)
  {
    $refaccion=Gos_OS_Refaccion::find($id);
    return($refaccion);
  }



  public function agregaritemrefacciones($id,Request $request ){
    $idtaller=Session::get('taller_id');
   $curtime = date('H:i:s');
   $hoy = date("Y-m-d H:i:s");
   if($request->gos_os_refaccion_id>0){
   $refaccion=Gos_OS_Refaccion::find($request->gos_os_refaccion_id);

   $refaccion->nombre=$request->Nombre;
   $refaccion->proveedor=$request->proveedor;
   if ($refaccion->proveedor>0) {
      $refaccion->fecha_asignado=$hoy;
   }
   $refaccion->proveedor_email=$request->proveedor_email;
   $refaccion->fecha_solicitud=($request->fecha_solicitud." ".$curtime);
   $refaccion->fecha_promesa=($request->fecha_promesa." ".$curtime);
   $refaccion->nro_parte="nopart";
   $refaccion->observaciones="...";
   $refaccion->save();
   }
   else{
   $refacciones= new Gos_OS_Refaccion();
   $refacciones->gos_os_id=$request->gos_os_id;
   $refacciones->nombre=$request->Nombre;
   $refacciones->proveedor=$request->proveedor;
   $refacciones->gos_os_refaccion_estatus_id=2;
   $refacciones->proveedor_email=$request->proveedor_email;
   $refacciones->fecha_solicitud=($request->fecha_solicitud." ".$curtime);
   if ($request->fecha_promesa!=null) {
      $refacciones->fecha_promesa=($request->fecha_promesa." ".$curtime);
   }
   $refacciones->nro_parte="nopart";
   $refacciones->observaciones="...";
   $refacciones->gos_taller_id=$idtaller;
   if ($refacciones->proveedor>0) {
      $refacciones->fecha_asignado=$hoy;
      if ($refacciones->gos_os_refaccion_estatus_id<9 && $refacciones->gos_os_refaccion_estatus_id!=5) {
          $refacciones->gos_os_refaccion_estatus_id=6;
      }
   }
   $refacciones->save();
   }
    return($request);
  }
  public function eliminaritemrefaccion($id)
  {
    $refaccion=Gos_OS_Refaccion::Find($id);
    $refaccion->delete();
    return("Eliminadas");
  }

//---------------------------------------UPDATES ESTATUSES REFACCIONES-----------------------------------
 public function CancelarRefaccion(Request $request){
    $hoy = date("Y-m-d H:i:s");
    $refaccion=Gos_OS_Refaccion::Find($request->idrefaccion);
    $refaccion->gos_os_refaccion_estatus_id=$request->idestatus;
    $refaccion->fecha_cancelado=$hoy;
    $refaccion->save();
    return("cancelado");
  }

 public function guardarref($id,Request $request){
    $hoy = date("Y-m-d H:i:s");
    $idtaller=Session::get('taller_id');
    $refacciones=Gos_OS_Refaccion::where('gos_os_id',$id)->get();
   foreach ($refacciones as $refa) {
    $refaid=$refa->gos_os_refaccion_id;
    $refa->gos_taller_id=$idtaller;
    $refa->nro_parte=$request->input('parte'.$refaid);
    $refa->observaciones=$request->input('obs'.$refaid);
    $refa->ubicacion=$request->input('ubica'.$refaid);
    $CRecibido=$request->input('chekRecibido'.$refaid);
    $CEntregado=$request->input('chekEntregado'.$refaid);
    $CPortal=$request->input('chekPortal'.$refaid);
    if ($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5) {
    if ($CRecibido==1) {$refa->fecha_recibido=$hoy; $refa->gos_os_refaccion_estatus_id=7;}
    if ($CEntregado==1) {$refa->fecha_entregado=$hoy; $refa->gos_os_refaccion_estatus_id=8;}
    if ($CPortal==1) {$refa->fecha_portal=$hoy;}
    }

    $refa->save();
   }
   return($refacciones);
 }

 public function updatefecha($id,$typo)
    {
      $hoy = date("Y-m-d H:i:s");
      $refa=Gos_OS_Refaccion::find($id);
      if($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5){
      if ($typo==0) {$refa->fecha_recibido=$hoy;$refa->gos_os_refaccion_estatus_id=7;$refa->save();}
      if ($typo==1) {$refa->fecha_entregado=$hoy;$refa->gos_os_refaccion_estatus_id=8;$refa->save();}
      if ($typo==2) {$refa->fecha_portal=$hoy; $refa->save();}
      }
      return($id);
    }

 public function updateprovedor(Request $request){
   $hoy = date("Y-m-d H:i:s");
   $id=$request->idrefacion;
   $refa=Gos_OS_Refaccion::find($id);
     if($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5){
       $refa->fecha_asignado=$hoy;
       $refa->proveedor=$request->idprov;
       $refa->fecha_promesa=$request->fechaprom;
       $refa->gos_os_refaccion_estatus_id=6;
       $refa->save();
     }
   return("provedor updated");
 }
 public function createandupdateprovedor(Request $request){
   $idtaller=Session::get('taller_id');
   $nprovedor=new Gos_Proveedor();
   $nprovedor->nomb_proveedor=$request->nombreprov;
   $nprovedor->contacto=$request->contactoprov;
   $nprovedor->gos_taller_id=$idtaller;
   $nprovedor->telefono=$request->telprov;
   $nprovedor->email=$request->mailprov;
   $nprovedor->save();
   $hoy = date("Y-m-d H:i:s");
   $refa=Gos_OS_Refaccion::find($request->gos_os_refaccion_id2);
     if($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5){
       $refa->fecha_asignado=$hoy;
       $refa->proveedor=$nprovedor->gos_proveedor_id;
       $refa->fecha_promesa=$request->fpprov;
       $refa->gos_os_refaccion_estatus_id=6;
       $refa->save();
     }
      return($request);
 }
 public function refrechasada($id){
   $refa=Gos_OS_Refaccion::find($id);
    if($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5){
      $refa->gos_os_refaccion_estatus_id=4;
      $refa->save();
    }
    return("rechasada");
 }
 public function refnoautorizada($id){
    $refa=Gos_OS_Refaccion::find($id);
   if($refa->gos_os_refaccion_estatus_id<9 && $refa->gos_os_refaccion_estatus_id!=5){
      $refa->gos_os_refaccion_estatus_id=5;
      $refa->save();
   }
  return("noautorizada");
 }
 public function Autorizarrefacciones($OSID){
  $idtaller=Session::get('taller_id');
  $refacciones= Gos_OS_Refaccion::where('gos_os_id',$OSID)->get();
  foreach ($refacciones as $refa) {
  if($refa->gos_os_refaccion_estatus_id<3){
   $refa->gos_os_refaccion_estatus_id=3;
   $refa->save();
     }}
     return("autorizadas");
  }

  public function EntrgarRef($OSID){
       $hoy = date("Y-m-d H:i:s");
   $idtaller=Session::get('taller_id');
   $refacciones= Gos_OS_Refaccion::where('gos_os_id',$OSID)->get();
   foreach ($refacciones as $refa) {
   if($refa->gos_os_refaccion_estatus_id<8 && $refa->gos_os_refaccion_estatus_id!=5){
    $refa->gos_os_refaccion_estatus_id=8;
     $refa->fecha_entregado=$hoy;
    $refa->save();
      }}
      return("autorizadas");
   }

   public function FPortarlRef($OSID){
   $hoy = date("Y-m-d H:i:s");
    $idtaller=Session::get('taller_id');
    $refacciones= Gos_OS_Refaccion::where('gos_os_id',$OSID)->get();
    foreach ($refacciones as $refa) {
    if($refa->gos_os_refaccion_estatus_id>7){
     $refa->fecha_portal=$hoy;
     $refa->save();
     }}
       return("fportal");
    }

 public function imprimir($id){
     $hoy = date("Y-m-d ");
     $nombrefile="HojaViajera.pdf";
      $os=Gos_V_Os::find($id);
      $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
      $cliente=Gos_Cliente::find($os->gos_cliente_id);
      $vehiculo=Gos_Vehiculo::find($os->gos_vehiculo_id);
      $vehiculoMod=Gos_Vehiculo_Modelo::find($vehiculo->gos_vehiculo_modelo_id);
      $vehiculoMarca=Gos_Vehiculo_Marca::find($vehiculoMod->gos_vehiculo_marca_id);
      $vehiculoColor=Gos_Color::where('codigohex',$vehiculo->color_vehiculo)->first();
      if ($os!=null) {
          $nombrefile=$os->nro_orden_interno.'HojaViajera.pdf';
        $ossplit=explode('|', $os->nomb_aseguradora);
      }
      else{$ossplit=array("ND","ND","ND","ND","Poliza: ND","Poliza: ND","ND","ND","ND","ND","ND","ND","Daño: ND","Daño: ND","ND","Estatus: ND");}
       $compact = array();
       $compact = compact('cliente','vehiculo','vehiculoColor','vehiculoMod','vehiculoMarca','ossplit','os','refacciones','hoy');
      return PDF::loadView('OS.Refacciones.refaccionespdf', $compact)->inline($nombrefile);
   }


 public function guardarcomentario($id,Request $request){
       $mail=0; $etlen=0; $provlen=0;      $hoy = date("Y-m-d H:i:s");
          $idtaller=Session::get('taller_id');
         if ($request->cmequipotrabajo!=null) {
              $etlen=count($request->cmequipotrabajo);
         }
         if ($request->cmprovedor!=null) {
            $provlen=count($request->cmprovedor);
         }
         $cadprov=""; $cadetrab="";
         $hoy = date("Y-m-d H:i:s");
         $user=Session::get('usr_Data');
         //MENSAJES INTERNOS____________________
           if ($etlen>0) {
             foreach ($request->cmequipotrabajo as $IUsuario) {
               $comentarioref=new Gos_Os_Mensajes();
               $comentarioref->de="ref";
               $comentarioref->para="ref";
               $comentarioref->fecha=$hoy;
               $comentarioref->asunto="Refacciones";
               $comentarioref->cuerpo=$request->cmobservaciones;
               $comentarioref->gos_os_id=$id;
               $comentarioref->leido=0;
               $comentarioref->prioridad=0;
               $comentarioref->gos_usuario_id=$user->gos_usuario_id;
               $comentarioref->visble=0;
               $comentarioref->gos_usuario_envio=$IUsuario;
               $comentarioref->save();
              }
           }
           else{
             $comentarioref=new Gos_Os_Mensajes();
             $comentarioref->de="ref";
             $comentarioref->para="ref";
             $comentarioref->fecha=$hoy;
             $comentarioref->asunto="Refacciones";
             $comentarioref->cuerpo=$request->cmobservaciones;
             $comentarioref->gos_os_id=$id;
             $comentarioref->leido=0;
             $comentarioref->prioridad=0;
             $comentarioref->gos_usuario_id=$user->gos_usuario_id;
             $comentarioref->visble=0;
             $comentarioref->gos_usuario_envio=0;
            $comentarioref->save();
           }
         //Mensajes Internos_______________________ END

//_______________________________MAILABLES->__________________________________

             $idtaller=Session::get('taller_id');
                $user=Session::get('usr_Data');
                $idtaller=Session::get('taller_id');
                //____________________________________________________________MAIL POR ESTATUS
               if ($request->cmestatusrefa>0) {
                 if ($etlen>0 ){
                            $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
                            if ($request->cmestatusrefa==2) {$refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',3)->get();}
                            if ($request->cmestatusrefa==3) {$refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',6)->wheredate('fecha_promesa','>',$hoy)->get(); }
                            if ($request->cmestatusrefa==4) {$refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',6)->wheredate('fecha_promesa','<',$hoy)->get(); return($refacciones);}
                            if ($request->cmestatusrefa==5) {$refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',7)->get();}
                           foreach ($request->cmequipotrabajo as $IUsuario){
                           $usr=Gos_V_Usuarios::find($IUsuario);
                           $mensajebody=$request->cmobservaciones;
                           $os=Gos_V_Os::find($id);
                           $taller = Gos_Taller::where('gos_taller_id',$idtaller)->get();
                            $details = [
                                'title' => 'SOLICITUD DE PIEZAS (COPIA)',
                                'body' =>$mensajebody,
                                'envio' =>$user,
                                'taller' =>  $taller,
                                'refacciones' =>$refacciones,
                                'os' => $os,
                            ];
                            \Mail::to($usr->email)->send(new \App\Mail\ECorreo($details));
                            }}
                            //_____________________________________ENVIO A CORREOS EXTERNOS_____________________________________________
                            if ($request->cmcorreoexterno!=null) {
                                $arrExternos=explode(",",$request->cmcorreoexterno);
                                $lenext=count($arrExternos);
                                if ($lenext>0) {
                                 foreach ($arrExternos as $externo){
                                     $mail=trim($externo);
                                     $details = [
                                         'title' => 'SOLICITUD DE PIEZAS (COPIA)',
                                         'body' =>$mensajebody,
                                         'envio' =>$user,
                                         'taller' =>  $taller,
                                         'refacciones' =>$refacciones,
                                         'os' => $os,
                                    ];
                              \Mail::to($mail)->send(new \App\Mail\ECorreo($details));
                        }}}
                   return back();
               }
                //_________________________________enviar solo a todos los prov con refacciones___________________________________________________________
            if($request->cmprovedor==null){
                  $refacciones= Gos_V_OS_Refaccion::where('gos_os_id',$id)->get();
                  $cadprovref=""; $cadprovs="";
                  foreach ($refacciones as $ref) {$cadprovref=$cadprovref.",".$ref->proveedor;}
                  $inprov=explode(",",$cadprovref);
                  $listaprovconrefac=Gos_Proveedor::where('gos_taller_id', $idtaller)->wherein('gos_proveedor_id',$inprov)->get();
                  foreach ($listaprovconrefac as $provc2) {$cadprovs=$cadprovs.$provc2->gos_proveedor_id.",";}
                 $ar2prov=explode(",",$cadprovs);
                 foreach ($ar2prov as $prov) {
                   $usr=Gos_V_Usuarios::find($user->gos_usuario_id);
                   $UIprov=Gos_Proveedor::find($prov);
                   if($UIprov!=null){
                   $mensajebody=$request->cmobservaciones;
                   $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('proveedor',$UIprov->gos_proveedor_id)->where('gos_os_refaccion_estatus_id',6)->get();
                   $os=Gos_V_Os::find($id);
                   $taller = Gos_Taller::where('gos_taller_id',$idtaller)->get();
                    $details = [
                        'title' => 'SOLICITUD DE PIEZAS',
                        'body' =>$mensajebody,
                        'envio' =>$user,
                        'taller' =>  $taller,
                        'refacciones' =>$refacciones,
                        'os' => $os,
                    ];
                   \Mail::to($UIprov->email)->send(new \App\Mail\ECorreo($details));
                 }}}
                  //____________________________________________ENVIO A PROVEDORES SELECCIONADOS__________________________________________________
          if ($provlen>0){
                    $os=Gos_V_Os::find($id);
                    $vehi=explode('|',$os->detallesVehiculo);
                    $Mtitle="Cotizacion De Refacciones: ".$vehi[1];
                    $mensajebody="Listado De Refacciones ";
                    $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
                       foreach ($request->cmprovedor as $prov) {
                             $usr=Gos_V_Usuarios::find($user->gos_usuario_id);
                             $UIprov=Gos_Proveedor::find($prov);
                             $mensajebody=$request->cmobservaciones;
                             $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('proveedor',$UIprov->gos_proveedor_id)->where('gos_os_refaccion_estatus_id',6)->get();
                             $os=Gos_V_Os::find($id);
                             $taller = Gos_Taller::where('gos_taller_id',$idtaller)->get();
                              $details = [
                                  'title' => 'SOLICITUD DE PIEZAS',
                                  'body' =>$mensajebody,
                                  'envio' =>$user,
                                  'taller' =>  $taller,
                                  'refacciones' =>$refacciones,
                                  'os' => $os,
                              ];
                             \Mail::to($UIprov->email)->send(new \App\Mail\ECorreo($details));
                         }}
                         //__________________________________ENVIO A EQUIPO DE TRABAJO SELECCIONADO__________________________________________________
                         if ($etlen>0 ){
                                   foreach ($request->cmequipotrabajo as $IUsuario){
                                   $usr=Gos_V_Usuarios::find($IUsuario);
                                   $mensajebody=$request->cmobservaciones;
                                   $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
                                   $os=Gos_V_Os::find($id);
                                   $taller = Gos_Taller::where('gos_taller_id',$idtaller)->get();
                                    $details = [
                                        'title' => 'SOLICITUD DE PIEZAS (COPIA)',
                                        'body' =>$mensajebody,
                                        'envio' =>$user,
                                        'taller' =>  $taller,
                                        'refacciones' =>$refacciones,
                                        'os' => $os,
                                    ];
                                    \Mail::to($usr->email)->send(new \App\Mail\ECorreo($details));
                                    }}
                                    //_____________________________________ENVIO A CORREOS EXTERNOS_____________________________________________
                                    if ($request->cmcorreoexterno!=null) {
                                        $arrExternos=explode(",",$request->cmcorreoexterno);
                                        $lenext=count($arrExternos);
                                          $refacciones= Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
                                        if ($lenext>0) {
                                         foreach ($arrExternos as $externo){
                                             $mail=trim($externo);
                                             $details = [
                                                 'title' => 'SOLICITUD DE PIEZAS (COPIA)',
                                                 'body' =>$mensajebody,
                                                 'envio' =>$user,
                                                 'taller' =>  $taller,
                                                 'refacciones' =>$refacciones,
                                                 'os' => $os,
                                            ];
                                      \Mail::to($mail)->send(new \App\Mail\ECorreo($details));
                                }}}
          return back();
   }//________________________________END___________ MAILABLE AND INTERNAL MESSAGE  END__________________________________________________________________________________


   public function countrefaccionespros($osid,$cadpov){
     $hoy = date("Y-m-d H:i:s");
       $cadprovs=""; $enpros=0; $vencidas=0; $entregadas=0;
       $idtaller=Session::get('taller_id');
       $arprov=explode(',',$cadpov);
       $provedoressel=Gos_Proveedor::where('gos_taller_id', $idtaller)->wherein('gos_proveedor_id',$arprov)->get();
       foreach ($provedoressel as $prov) {
        $cadprovs=$cadprovs.$prov->nomb_proveedor." - ";
       }
       $countref = Gos_OS_Refaccion::where('gos_os_id', $osid)->whereIn('proveedor',$arprov)->get();
       foreach ($countref as $current) {
         if ($current->gos_os_refaccion_estatus_id==6){
            if ($current->fecha_promesa>$hoy) {
              $enpros=$enpros+1;
            }
            else {
             $vencidas=$vencidas+1;
            }
         }
        if ($current->gos_os_refaccion_estatus_id==7) {$entregadas=$entregadas+1;}
       }
       $ret=array("provedores"=>$cadprovs, "enrpos"=>$enpros ,"venc" =>$vencidas, "entreg"=>$entregadas) ;
       return($ret);

    }
     public function countrefaccioneestatus($osid,$sel){
      $hoy = date("Y-m-d H:i:s");
      $cadHtml=""; $todas=0;$Autorizado=0; $enpros=0; $vencidas=0; $entregadas=0;
         $countref = Gos_OS_Refaccion::where('gos_os_id', $osid)->get();
         foreach ($countref as $current) {
           $todas=$todas+1;
           if ($current->gos_os_refaccion_estatus_id==3){$Autorizado=$Autorizado+1;}
           if ($current->gos_os_refaccion_estatus_id==6){
              if ($current->fecha_promesa>$hoy) {
                $enpros=$enpros+1;
              }
              else {
               $vencidas=$vencidas+1;
              }
           }
          if ($current->gos_os_refaccion_estatus_id==7) {$entregadas=$entregadas+1;}
         }
        if ($sel==1) {
         $cadHtml='<label>Todas:'.$todas.'</label><br ><label>Sin Proovedor:'.$Autorizado.'</label><br ><label>En Tiempo:'.$enpros.'</label><br> <label>Fuera de Tiempo:'.$vencidas.'</label><br> <label>Recibidas:'.$entregadas.'</label><br>';
        }
       if ($sel==2) {$cadHtml='<br ><label>Todas:'.$todas.'<br ><label>Sin Proovedor:'.$Autorizado.'</label>';}
       if ($sel==3) {$cadHtml='<br ><label>Todas:'.$todas.'<br ><label>En Tiempo:'.$enpros.'</label>';}
       if ($sel==4) {$cadHtml='<br ><label>Todas:'.$todas.'<br ><label>Fuera de Tiempo:'.$vencidas.'</label>';}
       if ($sel==5) {$cadHtml='<br ><label>Todas:'.$todas.'<br ><label>Recibidas:'.$entregadas.'</label>';}
      return($cadHtml);
     }

}//__CLASS
