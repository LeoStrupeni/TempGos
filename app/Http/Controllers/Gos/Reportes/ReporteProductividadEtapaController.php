<?php
namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use GosClases\ReporteProductividadEtapa;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_OS;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_V_Os;
class ReporteProductividadEtapaController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $idtaller=Session::get('taller_id');
      $listaProductividad = DB::select( DB::raw("SELECT D.nombre, fecha_inicio_et, fecha_cierre_et, orden_etapa, total, tiempo_segundos, terminadas, IFNULL(en_proceso,0) as procesada, tiempo_meta
      FROM (SELECT *,gos_fn_horas_minutos(SUM(TIME_TO_SEC(total))/ count(*)) tiempo_segundos, count(*) terminadas
            FROM (SELECT nombre, fecha_inicio_et, fecha_cierre_et, orden_etapa,IF(fecha_cierre_et>0 ,IF(TIMEDIFF(fecha_cierre_et,fecha_inicio_et ) > 0 , TIMEDIFF(fecha_cierre_et ,fecha_inicio_et) ,0), 0) total, tiempo_meta
            FROM gos_v_os_etapas
            WHERE estado_etapa = 'F' AND gos_taller_id = $idtaller ) AS F
            GROUP BY nombre
            ORDER BY orden_etapa) AS D
            LEFT JOIN (SELECT nombre, count(*) en_proceso
            FROM gos_v_os_etapas
            WHERE estado_etapa = 'A' AND gos_taller_id = $idtaller
            GROUP BY nombre) AS T ON D.nombre = T.nombre"));
      // return ($listaProductividad);
      $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $usuario=Session::get('usr_Data');
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $listaDano =  Gos_OS_Tipo_Danio::all();
      $listaEstado =  Gos_OS_Estado_Exp::all();
      $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',$idtaller)->get();

      return view('/Reportes/ReporteProductividadEtapa', compact('listaEtapas','listaProductividad','listaAseguradora','listaDano','listaEstado','taller_conf_ase','taller_conf_vehiculo'));
    }

    public function indexV2(){
        $cadfilter="";
      $fechahoy = date("Y-m-31"); $mesatras=date("Y-m-01");
     $idtaller=Session::get('taller_id');
     $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $idtaller)->first();
     $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $idtaller)->first();
     $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
     $listaDano =  Gos_OS_Tipo_Danio::all();
     $listaEstado =  Gos_OS_Estado_Exp::all();
     $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',$idtaller)->get();
     $Ordenes=Gos_OS::where('gos_taller_id', $idtaller)->get();
      $cados="";
      foreach ($Ordenes as $Orden) {
        $cados=$cados.",".$Orden->gos_os_id;
       }
       $inOS=explode(",",$cados);
       $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->whereDate('fecha_inicio_et','>=',$mesatras)->whereDate('fecha_inicio_et','<',$fechahoy)->get();

     return view('/Reportes/ReporteProductividadEtapa', compact('idtaller','taller_conf_ase','taller_conf_vehiculo','listaAseguradora','listaDano','listaEstado','listaEtapas','gos_items','cadfilter'));
    }

    public function filtros(Request $request){
       $rfechas=array();
       $rangofec=$request->rangoFechas;
       $rfechas=explode('-',$rangofec);
       $Fini=$rfechas[0];
       $Ffin=$rfechas[1];
       $Fini=date("Y-m-d", strtotime($Fini));
       $Ffin=date("Y-m-d", strtotime($Ffin. ' +1 day'));
       //dd($Fini,$Ffin);
       //__________ DATE FORMAT END ________________
      $cadfilter="";
      $fechahoy = date("Y-m-31"); $mesatras=date("Y-m-01");
     $idtaller=Session::get('taller_id');
     $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $idtaller)->first();
     $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $idtaller)->first();
     $listaAseguradora = Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
     $listaDano =  Gos_OS_Tipo_Danio::all();
     $listaEstado =  Gos_OS_Estado_Exp::all();
     $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',$idtaller)->get();
     $Ordenes=Gos_OS::where('gos_taller_id', $idtaller)->get();
      //filtros Ordenees__________________
      if ($request->aseguradora>0) { $Ordenes=Gos_OS::where('gos_taller_id', $idtaller)->where('gos_aseguradora_id',$request->aseguradora)->get();}
      if ($request->tipo_dano>0) { $Ordenes=Gos_OS::where('gos_taller_id', $idtaller)->where('gos_os_tipo_danio_id',$request->tipo_dano)->get();}
      if ($request->tipo_dano>0 && $request->aseguradora>0) {  $Ordenes=Gos_OS::where('gos_taller_id', $idtaller)->where('gos_aseguradora_id',$request->aseguradora)->where('gos_os_tipo_danio_id',$request->tipo_dano)->get();}
      //______________________________________
      $cados="";
      foreach ($Ordenes as $Orden) {
        $cados=$cados.",".$Orden->gos_os_id;
       }
       $inOS=explode(",",$cados);
       $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->whereDate('fecha_inicio_et','>=',$Fini)->whereDate('fecha_inicio_et','<',$Ffin)->get();
      //__________________FILTROS ITEMS_____________________________________________________
      if ($request->estado=="A" ) {
          $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->where('estado_etapa',$request->estado)->whereDate('fecha_inicio_et','>=',$Fini)->whereDate('fecha_inicio_et','<',$Ffin)->get();
        }
        if (  $request->estado=="F") {
            $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->where('estado_etapa',$request->estado)->whereDate('fecha_cierre_et','>=',$Fini)->whereDate('fecha_cierre_et','<',$Ffin)->get();
          }


      if ($request->etapa!=null) {
          $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->wherein('gos_paq_etapa_id',$request->etapa)->whereDate('fecha_inicio_et','>=',$Fini)->whereDate('fecha_inicio_et','<',$Ffin)->get();
             if ($request->estado=="A") {
                $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->wherein('gos_paq_etapa_id',$request->etapa)->where('estado_etapa',$request->estado)->whereDate('fecha_inicio_et','>=',$Fini)->whereDate('fecha_inicio_et','<',$Ffin)->get();
             }
               if (  $request->estado=="F") {
                   $gos_items=Gos_Os_Item::wherein('gos_os_id',$inOS)->wherein('gos_paq_etapa_id',$request->etapa)->where('estado_etapa',$request->estado)->whereDate('fecha_cierre_et','>=',$Fini)->whereDate('fecha_cierre_et','<',$Ffin)->get();
               }
         }

      //__________________FILTROS ITEMS_____________________________________________________
     return view('/Reportes/ReporteProductividadEtapa', compact('idtaller','taller_conf_ase','taller_conf_vehiculo','listaAseguradora','listaDano','listaEstado','listaEtapas','gos_items','cadfilter'));
    }

    public function dtitemstetapa($etapaid,$cados){
     $idtaller=Session::get('taller_id');
     $Intem=explode('|',$cados); $cadcoma="1";
     foreach ($Intem as $current) {
       if ($current!=null) {
        $cadcoma=$cadcoma.','.$current;
       }}
       $selectDB="SELECT gvic.* ,goi.gos_os_item_id,gvoe.tiempo_meta_texto,gvoe.fecha_inicio_et,gvoe.tiempo_meta_calculado
             FROM gos_v_inicio_calendario as gvic
             inner JOIN gos_os_item as goi ON goi.gos_os_id = gvic.gos_os_id
             LEFT JOIN gos_v_os_etapas_mod as gvoe ON gvoe.gos_os_item_id = goi.gos_os_item_id
             WHERE  gvic.gos_os_id in ( $cadcoma )
             GROUP BY gvic.gos_os_id
             ORDER BY gvic.nro_orden_interno ASC";

    $items=Gos_V_Os::wherein('gos_os_id',$Intem)->get();
    $items= DB::select( DB::raw($selectDB));

     $ajax = $this->preparaDataTableAjax($items, $this->getOpcionesEditDataTable());
     if (null != $ajax) {
         return $ajax;
     }
    }

    public function tiempoMeta($tiempo_meta, $date){
              $dayofweek = date("w")+1;
              $idtaller=Session::get('taller_id');
              $etapas = DB::select(DB::raw("SELECT *
              FROM
              gos_v_os_etapas WHERE estado_etapa = 'F'"));

              $tiempo_meta = $etapas[1]->tiempo_meta;
              $fecha_inicio = $etapas[1]->fecha_inicio_et;
              $tiempo_meta = (int)$tiempo_meta;

              $taller = DB::select(DB::raw("SELECT *
              FROM
              gos_taller_horas_habil WHERE gos_taller_id = $idtaller
              AND dia = $dayofweek"));

              $tiempoEtapa = date("H:i:s", strtotime($fecha_inicio));
              $etapaFin =0;
              if($tiempo_meta >0){

                if($tiempoEtapa > $taller[0]->dia_hora_inicio && $tiempoEtapa < $taller[0]->dia_hora_fin){
                  $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                  if($etapaFin > $taller[1]->dia_hora_fin){
                    $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                  }
                  else if($etapaFin < $taller[0]->dia_hora_fin){
                    if($etapaFin > $taller[1]->dia_hora_fin){
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));

                    }else if($etapaFin <  $taller[0]->dia_hora_fin){
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));
                    }
                    else{
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));

                    }
                  }
                  else if($tiempo_meta >= 24){
                    $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    if($etapaFin < $taller[0]->dia_hora_inicio){
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    }
                  }
                  else{
                    $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));
                    if($etapaFin < $taller[0]->dia_hora_fin){
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));
                    }
                    else{
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    }
                  }
                }
                else if($tiempoEtapa > $taller[1]->dia_hora_inicio && $tiempoEtapa < $taller[1]->dia_hora_fin){
                  $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));
                  if($etapaFin > $taller[1]->dia_hora_fin){
                    $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    if($etapaFin > $taller[0]->dia_hora_fin){

                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    }
                    else{
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));

                    }
                  }
                  else if($tiempo_meta >= 24){
                    $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    if($etapaFin < $taller[0]->dia_hora_inicio){
                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas+$taller[0]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                    }
                  }
                  else{
                    if($etapaFin < $taller[0]->dia_hora_inicio){
                      $etapaFin = date('H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                      if($etapaFin < $taller[0]->dia_hora_inicio){

                        $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));
                      }
                      else{
                        $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$taller[0]->horas_muertas+$taller[1]->horas_muertas+$taller[1]->horas_muertas.' hour ',strtotime($fecha_inicio)));

                      }
                    }
                    else{

                      $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta.' hour ',strtotime($fecha_inicio)));
                    }
                  }
                }
                else if($tiempoEtapa > $taller[1]->dia_hora_inicio ){
                  $t = floor(strtotime(date("H:i:s",strtotime($fecha_inicio))) / 3600) - floor(strtotime($taller[0]->dia_hora_inicio) / 3600);
                  $etapaFin = date('Y-m-d H:i:s',strtotime('+'.$tiempo_meta+$t.' hour ',strtotime($fecha_inicio)));

                }
              }
              else{
                $etapaFin = $fecha_inicio;
              }
              return $etapaFin;
    }
    public function preparaDataTableOrdenes($nombre, $fecha, $estatus, $dano, $aseguradora){
              $idtaller=Session::get('taller_id');
              $query = "SELECT
              IF(fecha_cierre_et > GOS_FN_TALLER_TIEMPO(tiempo_meta,
                          fecha_inicio_et,
                          d.gos_taller_id),
                  0,
                  1) AS fin_etapa,
              CONCAT(fecha_inicio_et,
                      '|',
                      fecha_cierre_et,
                      '|',
                      fecha_promesa_os,
                      '|',
                      GOS_FN_TALLER_TIEMPO(tiempo_meta,
                              fecha_inicio_et,
                              d.gos_taller_id)) AS fecha_fin_etapa,
              d.*,
              g.*
             FROM
              gos_v_os_etapas d
                  INNER JOIN
              gos_v_inicio_calendario g ON d.gos_os_id = g.gos_os_id
              WHERE  d.gos_taller_id = ".$idtaller."
              AND nombre = '".$nombre."'
              AND d.estado_etapa = 'F' ";
              if($fecha != 0){
                $query .= " AND d.fecha_inicio_et >= ".$fecha;
              }
              if($estatus != 0){
                $query .= " AND g.gos_os_estado_exp_id = " .$estatus;
              }
              if($dano != 0){
                $query .= " AND g.gos_os_tipo_danio_id = " .$dano;
              }
              if($aseguradora != 0){
                $query .= " AND g.gos_aseguradora_id = " .$aseguradora;
              }
               $query .=  " GROUP BY d.fecha_inicio_et";
               $ITemsOS = DB::select( DB::raw($query));
               $ajax = $this->preparaDataTableAjax($ITemsOS, $this->getOpcionesEditDataTable());
               if (null != $ajax) {
                   return $ajax;
               }
      }
    public function preparaDataTableOrdenesAct($nombre, $fecha, $estatus, $dano, $aseguradora){
                $idtaller=Session::get('taller_id');
                $query = "SELECT
                IF(fecha_cierre_et > GOS_FN_TALLER_TIEMPO(tiempo_meta,
                            fecha_inicio_et,
                            d.gos_taller_id),
                    0,
                    1) AS fin_etapa,
                CONCAT(fecha_inicio_et,
                        '|',
                        fecha_cierre_et,
                        '|',
                        fecha_promesa_os,
                        '|',
                        GOS_FN_TALLER_TIEMPO(tiempo_meta,
                                fecha_inicio_et,
                                d.gos_taller_id)) AS fecha_fin_etapa,
                d.*,
                g.*
            FROM
                gos_v_os_etapas d
                    INNER JOIN
                gos_v_inicio_calendario g ON d.gos_os_id = g.gos_os_id
                WHERE  d.gos_taller_id = ".$idtaller."
                AND nombre = '".$nombre."'
                AND d.estado_etapa = 'A' ";
                if($fecha != 0){
                  $query .= " AND d.fecha_inicio_et >= ".$fecha;
                }
                if($estatus != 0){
                  $query .= " AND g.gos_os_estado_exp_id = " .$estatus;
                }
                if($dano != 0){
                  $query .= " AND g.gos_os_tipo_danio_id = " .$dano;
                }
                if($aseguradora != 0){
                  $query .= " AND g.gos_aseguradora_id = " .$aseguradora;
                }
           $query .=  " GROUP BY d.fecha_inicio_et";
                $ITemsOS = DB::select( DB::raw($query));
                 $ajax = $this->preparaDataTableAjax($ITemsOS, $this->getOpcionesEditDataTable());
                 if (null != $ajax) {
                     return $ajax;
                 }
    }

}
