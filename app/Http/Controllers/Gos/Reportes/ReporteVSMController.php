<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use session;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_OS;
use App\Gos\Gos_Os_Item;
use PDF;
use App\Gos\Gos_Taller_Conf_vehiculo;

class ReporteVSMController extends Controller
{

    public function indexv2(){
      $fechahoy = date("Y-m-d"); $mesatras=date("Y-m-01 ");

      $start = strtotime(date('Y-m-d', strtotime($fechahoy)));
      $end = strtotime(date('Y-m-d', strtotime($mesatras)));
      $datediff = $start - $end;
      $days_between=   round($datediff / (60 * 60 * 24));
      $days_between=$days_between+1;
      //-----days
      $entregados=0; $terminados=0; $perpago=0; $Dnaturales=0; $PROMDDENTREGAS=0.00; $TiempoCICLO=0; $PromedioHrs=0; $TTSA=0; $DAYmin=$fechahoy; $DAYmax=""; $tciclo=0; $promDhoras=0; $Tos=0;
      $titems=0;   $genval=0; $genvalpor=0;    $NOgenval=0; $NOgenvalpor=0;

      $cadEntregados=0;
      $cadOS="";
      $cadAse="Todas";
      $cadfiltros=date('Y-m-d', strtotime($mesatras))." -A- ".date('Y-m-d', strtotime($fechahoy));
      $idtaller=Session::get('taller_id');
      $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $OS=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_creacion_os','>',$mesatras)->get();
      $entregados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_entregado','>',$mesatras)->count();
      $terminados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_terminado','>',$mesatras)->count();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();

      $etapas=Gos_Paq_Etapa::where('gos_taller_id',$idtaller)->get();
      foreach ($OS as $orden) {
      $cadOS=$cadOS.$orden->gos_os_id.',';
      if ($orden->gos_os_tipo_o_id>3) {$perpago=$perpago+1;}
      }
      $PROMDDENTREGAS=$entregados/$days_between;
      $Tos=count($OS);
      $INOS=explode(",",$cadOS);
      $osItems=Gos_Os_Item::where('gos_taller_id',$idtaller)->wherein('gos_os_id',$INOS)->get();
      //__________________________ENTREGADOS___
        $Ase=0; $fini=$end;  $ffin=$start;
     return View('Reportes/VSM/ReporteVSM')->with(compact('listaAseguradoras','etapas','osItems','cadfiltros','cadAse','genval','NOgenval','genvalpor','NOgenvalpor','entregados','days_between',
     'PROMDDENTREGAS','promDhoras','Tos','OS','terminados','perpago','fini','ffin','Ase','taller_conf_vehiculo'));
    }


    public function filterv2(Request $request){
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();

        $rfechas=array(); $Ase=0;
        $ase=$request->aseguradora;
        $rangofec=$request->rangoFechas;
        $rfechas=explode('-',$rangofec);
         $Fini=$rfechas[0];
         $Ffin=$rfechas[1];
         $Fini=date("Y-m-d", strtotime($Fini));
          $Ffin=date("Y-m-d", strtotime($Ffin));

      //-------------------------------------------- de aqui pa abajo no moverle
      $fechahoy = date("Y-m-d H:i:s"); $mesatras=date("Y-m-01 H:i:s");
      $start = strtotime(date('Y-m-d', strtotime($fechahoy)));
      $end = strtotime(date('Y-m-d', strtotime($mesatras)));
      $datediff = $start - $end;
      $days_between=   round($datediff / (60 * 60 * 24));
      $days_between=$days_between+1;
      $Ase=0;  $fini=$end;  $ffin=$start;
      //-----days
      $entregados=0; $Dnaturales=0; $PROMDDENTREGAS=0.00; $TiempoCICLO=0; $PromedioHrs=0; $TTSA=0; $DAYmin=$fechahoy; $DAYmax=""; $tciclo=0; $promDhoras=0; $Tos=0; $terminados=0; $perpago=0;
      $titems=0;   $genval=0; $genvalpor=0;    $NOgenval=0; $NOgenvalpor=0;
      $cadEntregados=0;
      $cadOS="";
      $cadAse="Todas";
      $cadfiltros=date('Y-m-d', strtotime($mesatras))." -A- ".date('Y-m-d', strtotime($fechahoy));
      $idtaller=Session::get('taller_id');
      $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $OS=Gos_OS::where('gos_taller_id',$idtaller) ->whereDate('fecha_creacion_os','<', $fechahoy) ->whereDate('fecha_creacion_os','>',$mesatras)->get();
      $entregados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_entregado','<', $fechahoy) ->whereDate('fecha_entregado','>',$mesatras)->count();
      $terminados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_terminado','<', $fechahoy) ->whereDate('fecha_terminado','>',$mesatras)->count();
      $etapas=Gos_Paq_Etapa::where('gos_taller_id',$idtaller)->get();
      //__________________________FILTROS
        if ($ase!=null) {
             $OS=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_creacion_os','<', $Ffin) ->whereDate('fecha_creacion_os','>',$Fini)->get();
             $entregados=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_entregado','<', $Ffin) ->whereDate('fecha_entregado','>',$Fini)->count();
             $terminados=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_terminado','<', $Ffin) ->whereDate('fecha_terminado','>',$Fini)->count();

             foreach ($listaAseguradoras as  $selase) {
               if ($selase->gos_aseguradora_id==$ase) {$cadAse=":".$selase->empresa;}
             }
               $Ase=$ase;
         }
       if ($Ffin!=null && $Fini!=null) {
           $OS=Gos_OS::where('gos_taller_id',$idtaller) ->whereDate('fecha_creacion_os','<', $Ffin) ->whereDate('fecha_creacion_os','>',$Fini)->get();
           $entregados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_entregado','<', $Ffin) ->whereDate('fecha_entregado','>',$Fini)->count();
           $terminados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_terminado','<', $Ffin) ->whereDate('fecha_terminado','>',$Fini)->count();
           $cadfiltros=$Fini." -A- ".$Ffin;

           $start = strtotime($Ffin);
           $end = strtotime( $Fini);
           $datediff = $start - $end;
           $days_between=   round($datediff / (60 * 60 * 24));
           $days_between=$days_between+1;
            $fini=$end;  $ffin=$start;

       }
       if ($ase!=null && $Ffin!=null && $Fini!=null) {
         $OS=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_creacion_os','<', $Ffin) ->whereDate('fecha_creacion_os','>',$Fini)->get();
         $entregados=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_entregado','<', $Ffin) ->whereDate('fecha_entregado','>',$Fini)->count();
         $terminados=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_terminado','<', $Ffin) ->whereDate('fecha_terminado','>',$Fini)->count();
           $Ase=$ase;
         foreach ($listaAseguradoras as  $selase) {
           if ($selase->gos_aseguradora_id==$ase) {$cadAse=":".$selase->empresa;}
         }
         $start = strtotime($Ffin);
         $end = strtotime( $Fini);
         $datediff = $start - $end;
         $days_between=   round($datediff / (60 * 60 * 24));
         $days_between=$days_between+1;
          $fini=$end;  $ffin=$start;
         $cadfiltros=$Fini." -A- ".$Ffin;
       }
      //_________________________________FILTROS
       $Tos=count($OS);
      foreach ($OS as $orden) {
      $cadOS=$cadOS.$orden->gos_os_id.',';
      if ($orden->gos_os_tipo_o_id>3) {$perpago=$perpago+1;}
      }
      $PROMDDENTREGAS=$entregados/$days_between;
      $INOS=explode(",",$cadOS);
      $osItems=Gos_Os_Item::where('gos_taller_id',$idtaller)->wherein('gos_os_id',$INOS)->get();

     return View('Reportes/VSM/ReporteVSM')->with(compact('listaAseguradoras','etapas','osItems','cadfiltros','cadAse','genval','NOgenval','genvalpor','NOgenvalpor','entregados','days_between','PROMDDENTREGAS','promDhoras','Tos','perpago','terminados','Ase','fini','ffin','taller_conf_vehiculo'));
    }



    public function VSMPDF($ase,$fini,$ffin){
      $cadOS=""; $days_between=0; $genval=0; $NOgenval=0; $genvalpor=0; $NOgenvalpor=0; $promDhoras=0;$perpago=0;
      $idtaller=Session::get('taller_id');
    if ($ase==0) {
      $Aseguradora="";
    }else {
      $Aseg=Gos_Aseguradora::find($ase);
      $Aseguradora="Aseguradora: ".$Aseg->empresa;
    }
    $fechaini=date("Y-m-d ", $fini);
    $fechafin=date("Y-m-d", $ffin);
    $start = strtotime($fechafin);
    $end = strtotime( $fechaini);
    $datediff = $start - $end;
    $days_between=round($datediff / (60 * 60 * 24));
    $days_between=$days_between+1;
    $OS=Gos_OS::where('gos_taller_id',$idtaller) ->whereDate('fecha_creacion_os','<', $fechafin) ->whereDate('fecha_creacion_os','>',$fechaini)->get();
    $entregados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_entregado','<', $fechafin) ->whereDate('fecha_entregado','>',$fechaini)->count();
    $terminados=Gos_OS::where('gos_taller_id',$idtaller)->whereDate('fecha_entregado','<', $fechafin) ->whereDate('fecha_entregado','>',$fechaini)->count();
    $etapas=Gos_Paq_Etapa::where('gos_taller_id',$idtaller)->get();
    $usuario=Session::get('usr_Data');
    $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();

    if ($ase>0) {
         $OS=Gos_OS::where('gos_taller_id',$idtaller)->where('gos_aseguradora_id',$ase)->whereDate('fecha_creacion_os','<', $fechafin) ->whereDate('fecha_creacion_os','>',$fechaini)->get();
     }
        $Tos=count($OS);
       foreach ($OS as $orden) {
       $cadOS=$cadOS.$orden->gos_os_id.',';
       if ($orden->gos_os_tipo_o_id>3) {$perpago=$perpago+1;}
       }
       $PROMDDENTREGAS=$entregados/$days_between;
       $INOS=explode(",",$cadOS);
       $osItems=Gos_Os_Item::where('gos_taller_id',$idtaller)->wherein('gos_os_id',$INOS)->get();
    $compact = array();
    $compact = compact('ase','fechaini','fechafin','Aseguradora','etapas','osItems','genval','NOgenval','genvalpor','NOgenvalpor','entregados','days_between','PROMDDENTREGAS','promDhoras','Tos','perpago','terminados','taller_conf_vehiculo');
    return PDF::loadView('Reportes/VSM/ReporteVSMPDF', $compact)->setPaper('a4', 'landscape')->inline('reportevsm.pdf');
    }




    public function VSMXLS($ase,$fini,$ffin){
    return('XLS');
    }
}
