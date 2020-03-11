<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use session;
use Illuminate\Support\Facades\DB;

use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Proveedor;
use App\Gos\Gos_Os_Refaccion_Estatus;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Os_Refaccion;
use App\Gos\Gos_V_Os_Refaccion;
use App\Gos\Gos_Taller_Conf_vehiculo;
use Illuminate\Support\Facades\Storage;
use App\Gos\Gos_Taller_Conf_ase;

class ReporteSeguimientoRefaccionesController extends controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usuario=Session::get('usr_Data');
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $cadOS=""; $cadRALL="";  $RSOL=0;  $REP=0; $RFV=0; $RFREC=0; $RAUT=0;  $RRECH=0; $RNA=0; $RFCN=0;$REC=0; $filtroPROV=0; $filtroEST=0;
      $hoy = date("Y-m-d h:i:s");
      $idtaller=Session::get('taller_id');
      $estatusrefaccionescanceladas=Gos_Os_Refaccion_Estatus::where('estatus_refaccion','like','%Cancelado%')->get();
      $listaSeleccionProveedores=Gos_Proveedor::where('gos_taller_id',$idtaller)->get();
      $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $listaSeleccionRefaccionStatus=Gos_Os_Refaccion_Estatus::all();
      $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','<',17)->get();
      $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();


      foreach ($refaccionesAll as $Rall) {
       $cadRALL=$cadRALL.$Rall->gos_os_id.",";
      }
      $INRALL=explode(",",$cadRALL);
      $os=Gos_V_Os::where('gos_taller_id',$idtaller)->wherein('gos_os_id',$INRALL)->get();
      foreach ($refaccionesAll as $RFAll) {
        if ($RFAll->gos_os_refaccion_estatus_id==1) {$RSOL =$RSOL+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==2) {$RSOL=$RSOL+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==3) {$RAUT=$RAUT+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==4) {$RRECH=$RRECH+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==6 && $RFAll->fecha_promesa<$hoy) {$RFV=$RFV+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==5) {$RNA=$RNA+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==6) {$REP=$REP+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==7) {$REC=$REC+1;}
        //if ($RFAll->gos_os_refaccion_estatus_id==8) {$ENT=$ENT+1;}
        if ($RFAll->gos_os_refaccion_estatus_id>=9 || $RFAll->gos_os_refaccion_estatus_id==5) {if ($RFAll->gos_os_refaccion_estatus_id<17) {$RFCN=$RFCN+1;}}
      }
      return view('/Reportes/ReporteSeguimientoRefacciones')->with(compact('listaAseguradoras','listaSeleccionProveedores','listaSeleccionRefaccionStatus','os','refaccionesVencidas','estatusrefaccionescanceladas','RSOL','REP','RFV','RFREC','RNA','RFCN','RAUT','RRECH','filtroPROV','filtroEST','taller_conf_vehiculo','taller_conf_ase'));
    }


    public function store(Request $request){
      $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $cadOS=""; $cadRALL="";  $RSOL=0;  $REP=0; $RFV=0; $RFREC=0; $RAUT=0;  $RRECH=0; $RNA=0; $RFCN=0;$REC=0; $filtroPROV=0; $filtroEST=0;
      $cadOS=""; $cadRALL="";  $RSOL=0;  $REP=0; $RFV=0; $RFREC=0; $RAUT=0;  $RRECH=0; $RNA=0; $RFCN=0;$REC=0;$REC=0; $filtroPROV=0; $filtroEST=0; $cadFILTROS="";
      $hoy = date("Y-m-d h:i:s");
      $idtaller=Session::get('taller_id');
      $listaSeleccionProveedores=Gos_Proveedor::where('gos_taller_id',$idtaller)->get();
      $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $listaSeleccionRefaccionStatus=Gos_Os_Refaccion_Estatus::all();
      $estatusrefaccionescanceladas=Gos_Os_Refaccion_Estatus::where('estatus_refaccion','like','%Cancelado%')->get();
      $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','<',17)->get();
      $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();
      //______________Begin filtros___________________________________________________
      $filtroOS=$request->Orden;   $filtroPROV=$request->provedor;    $filtroEST=$request->Estatus;  $filtroASE=$request->Aseguradora;
      //-----------------------------filterOS----------------------
      if ($filtroOS!=null) {
        $osfil=Gos_OS::where('gos_taller_id',$idtaller)->where('nro_orden_interno',$filtroOS)->first();
        $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_id',$osfil->gos_os_id)->get();
        $refaccionesVencidas=Gos_Os_Refaccion::where('gos_os_id',$filtroOS)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();
        $cadFILTROS="Filtros Activos:";
        $cadFILTROS=$cadFILTROS."Orden De Servicio".$filtroOS;
      }
      if ($filtroPROV!=null) {
        $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('proveedor',$filtroPROV)->get();
        $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->where('proveedor',$filtroPROV)->get();
        $cadFILTROS="Filtros Activos:  ";
        foreach ($listaSeleccionProveedores as $prov) {
          if ($prov->gos_proveedor_id==$filtroPROV) {
          $cadFILTROS=$cadFILTROS."Proveedor : ".$prov->nomb_proveedor;
          }}
      }
      if ($filtroEST!=null) {
        $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();
        if ($filtroEST==1){  $cadFILTROS="Filtros Activos : Pte Autorizacion ";
          $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','<',3)->get();}
          if ($filtroEST==2){ $cadFILTROS="Filtros Activos :  Sin Proveedor ";
            $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id',3)->get();}
            if ($filtroEST==3){ $cadFILTROS="Filtros Activos : EN Proceso (todas) ";
              $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id',6)->get();}
              if ($filtroEST==4){ $cadFILTROS="Filtros Activos : EN Proceso (tiempo) ";
                $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '>=',$hoy)->get();}
                if ($filtroEST==5){ $cadFILTROS="Filtros Activos : EN Proceso (fuera tiempo ) ";
                  $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();}
                  if($filtroEST==6){ $cadFILTROS="Filtros Activos : Rechazado";
                    $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',4)->get();}
                    if($filtroEST==7){ $cadFILTROS="Filtros Activos : Cancelado ";
                      $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','>',8)->get();
                      }

        }
      if ($filtroEST!=null && $filtroPROV!=null) {
          $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id',$filtroEST)->where('proveedor',$filtroPROV)->get();
        if ($filtroEST==1){  $cadFILTROS="Filtros Activos : Pte Autorizacion ";
          $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','<',3)->where('proveedor',$filtroPROV)->get();}
          if ($filtroEST==2){ $cadFILTROS="Filtros Activos :  Sin Proveedor ";
            $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id',3)->where('proveedor',$filtroPROV)->get();}
            if ($filtroEST==3){ $cadFILTROS="Filtros Activos : EN Proceso (todas) ";
              $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id',6)->where('proveedor',$filtroPROV)->get();}
              if ($filtroEST==4){ $cadFILTROS="Filtros Activos : EN Proceso (tiempo) ";
                $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '>=',$hoy)->where('proveedor',$filtroPROV)->get();}
                if ($filtroEST==5){ $cadFILTROS="Filtros Activos : EN Proceso (fuera tiempo ) ";
                  $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->where('proveedor',$filtroPROV)->get();}
                  if($filtroEST==6){ $cadFILTROS="Filtros Activos : Rechazado";
                    $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',4)->where('proveedor',$filtroPROV)->get();}
                    if($filtroEST==7){ $cadFILTROS="Filtros Activos : Cancelado ";
                      $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','>',8)->where('proveedor',$filtroPROV)->get();
                      }

        $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->where('gos_os_refaccion_estatus_id',$filtroEST)->where('proveedor',$filtroEST)->get();
          $cadFILTROS="Filtros Activos : ";
                foreach ($listaSeleccionProveedores as $prov) {if ($prov->gos_proveedor_id==$filtroPROV) {$cadFILTROS=$cadFILTROS."Proveedor : ".$prov->nomb_proveedor;}}
      }


      if ($filtroASE!=null) {
          $cadFILTROS="Filtros Activos : ";
          foreach ($listaAseguradoras as $ase){if ($ase->gos_aseguradora_id==$filtroASE) {$cadFILTROS=$cadFILTROS."Aseguradora : ".$ase->empresa;}}
          $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));

           if ($filtroPROV!=null) {
             foreach ($listaSeleccionProveedores as $prov) {if ($prov->gos_proveedor_id==$filtroPROV) {$cadFILTROS=$cadFILTROS."Proveedor : ".$prov->nomb_proveedor;}}
             $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and proveedor='.$filtroPROV.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));
           }
           if ($filtroEST!=null) {   $hoy = date("Y-m-d ");
             foreach ($listaSeleccionRefaccionStatus as $esta) { if ($esta->gos_os_refaccion_estatus_id==$filtroEST) {$cadFILTROS=$cadFILTROS." Estatus : ".$esta->estatus_refaccion;}}
               $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id='.$filtroEST.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));

               if ($filtroEST==1){  $cadFILTROS="Filtros Activos : Pte Autorizacion ";
                  $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id<3 and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                 if ($filtroEST==2){ $cadFILTROS="Filtros Activos :  Sin Proveedor ";
                   $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=3 and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                   if ($filtroEST==3){ $cadFILTROS="Filtros Activos : EN Proceso (todas) ";
                      $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                     if ($filtroEST==4){ $cadFILTROS="Filtros Activos : EN Proceso (tiempo) ";
                       $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and  fecha_promesa >='.$hoy.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                       if ($filtroEST==5){ $cadFILTROS="Filtros Activos : EN Proceso (fuera tiempo ) ";
                         $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and  fecha_promesa <='.$hoy.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                         if($filtroEST==6){ $cadFILTROS="Filtros Activos : Rechazado";
                          $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id= and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                           if($filtroEST==7){ $cadFILTROS="Filtros Activos : Cancelado ";
                             $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','>',8)->where('proveedor',$filtroPROV)->get();
                              $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=8 and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));
                             }
           }
           if ($filtroEST!=null && $filtroPROV!=null) { $hoy = date("Y-m-d ");
                  $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id='.$filtroEST.' and proveedor='.$filtroPROV.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));
                  if ($filtroEST==1){  $cadFILTROS="Filtros Activos : Pte Autorizacion ";
                     $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id<3 and proveedor='.$filtroPROV.'   and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                    if ($filtroEST==2){ $cadFILTROS="Filtros Activos :  Sin Proveedor ";
                      $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=3 and proveedor='.$filtroPROV.'  and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                      if ($filtroEST==3){ $cadFILTROS="Filtros Activos : EN Proceso (todas) ";
                         $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and proveedor='.$filtroPROV.'  and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                        if ($filtroEST==4){ $cadFILTROS="Filtros Activos : EN Proceso (tiempo) ";
                          $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and proveedor='.$filtroPROV.'  and  fecha_promesa>='.$hoy.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                          if ($filtroEST==5){ $cadFILTROS="Filtros Activos : EN Proceso (fuera tiempo ) ";
                            $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=6 and proveedor='.$filtroPROV.'  and  fecha_promesa<='.$hoy.' and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                            if($filtroEST==6){ $cadFILTROS="Filtros Activos : Rechazado";
                             $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id= and proveedor='.$filtroPROV.'  and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));}
                              if($filtroEST==7){ $cadFILTROS="Filtros Activos : Cancelado ";
                                $refaccionesAll=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','>',8)->where('proveedor',$filtroPROV)->get();
                                 $refaccionesAll = DB::select( DB::raw('select*from gos_os_refaccion where gos_taller_id='.$idtaller.' and gos_os_refaccion_estatus_id=8 and proveedor='.$filtroPROV.'  and gos_os_id in (select gos_os_id from gos_os where gos_aseguradora_id='.$filtroASE.');'));
                                }

                  foreach ($listaSeleccionProveedores as $prov) {if ($prov->gos_proveedor_id==$filtroPROV) {$cadFILTROS=$cadFILTROS."Proveedor : ".$prov->nomb_proveedor;}}
           }
           $refaccionesVencidas=Gos_Os_Refaccion::where('gos_taller_id',$idtaller)->where('gos_os_refaccion_estatus_id','=',6)->where('fecha_promesa', '<=',$hoy)->get();
      }



      //-------------------------------------------- End Filtros-----------------------------------------------------
      foreach ($refaccionesAll as $Rall) {
       $cadRALL=$cadRALL.$Rall->gos_os_id.",";
      }
      $INRALL=explode(",",$cadRALL);
      $os=Gos_V_Os::where('gos_taller_id',$idtaller)->wherein('gos_os_id',$INRALL)->get();
      foreach ($refaccionesAll as $RFAll) {
        if ($RFAll->gos_os_refaccion_estatus_id==1) {$RSOL =$RSOL+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==2) {$RSOL=$RSOL+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==3) {$RAUT=$RAUT+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==4) {$RRECH=$RRECH+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==6 && $RFAll->fecha_promesa<$hoy) {$RFV=$RFV+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==5) {$RNA=$RNA+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==6 && $RFAll->fecha_promesa>=$hoy) {$REP=$REP+1;}
        if ($RFAll->gos_os_refaccion_estatus_id==7) {$REC=$REC+1;}
        //if ($RFAll->gos_os_refaccion_estatus_id==8) {$ENT=$ENT+1;}
        if ($RFAll->gos_os_refaccion_estatus_id>=9 || $RFAll->gos_os_refaccion_estatus_id==5 && $RFAll->gos_os_refaccion_estatus_id<17 ) {$RFCN=$RFCN+1;}
      }
      return view('/Reportes/ReporteSeguimientoRefacciones')->with(compact('listaAseguradoras','listaSeleccionProveedores','listaSeleccionRefaccionStatus','os','refaccionesVencidas','RSOL','REP','RFV','RFREC','RNA','RFCN','RAUT','RRECH','REC','estatusrefaccionescanceladas','cadFILTROS','filtroPROV','filtroEST','taller_conf_vehiculo','taller_conf_ase'));
    }


      public function getdatatablerefacciones($id,$idprov,$idest){
          $refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->get();
          if ($idprov!=0) {
            $refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('proveedor',$idprov)->get();
          }
          if ($idest!=0) {
          //  $refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',$idest)->get();
          }
          if ($idprov!=0 && $idest!=0) {
            //()$refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('gos_os_refaccion_estatus_id',$idest)->where('proveedor',$idprov)->get();
            $refacciones=Gos_V_Os_Refaccion::where('gos_os_id',$id)->where('proveedor',$idprov)->get();
          }
          $opcionesEditDataTable2='.OS.Refacciones.OpcionesDataTable';
          $ajax = $this->preparaDataTableAjax($refacciones,$opcionesEditDataTable2);
          return($ajax);
          return($refacciones);
      }

        protected function preparaDataTableAjax($listaDatos, $vistaBotones = '', $columnaOpciones = 'Opciones'){
                if (request()->ajax()) {
                    return datatables()->of($listaDatos)
                        ->addColumn($columnaOpciones, $vistaBotones)
                        ->rawColumns([
                        $columnaOpciones
                    ])
                        ->addIndexColumn()
                        ->make(true);
                } else
                    return null;
        }
}
