<?php
namespace App\Http\Controllers\Gos;

//
use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Gos\Gos_V_Inicio_Creadas;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_V_Os_Mensajes;
use App\Gos\Gos_V_Inicio_Os_Etapas;
use App\Gos\Gos_Os_Mensajes;
use App\Gos\Gos_V_Inicio_Calendario;
use App\Gos\Gos_Paq_Servicio;
use App\Gos\Gos_V_Usuarios;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;

use Illuminate\Support\Facades\DB;
use Session;

/**
 *
 * @author yois
 *
 */
class HomeController extends GosControllers
{

    protected $vistaListado = 'Home/Inicio';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         $cadTec="";   $seracTec=[];
              $idtaller=Session::get('taller_id');
              $usuario=Session::get('usr_Data');
              $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
              $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();

              $NserviciosACtive=Gos_V_Os_Items::select('gos_paq_servicio_id')->where('gos_taller_id',$idtaller)->where('estado_etapa','=',"A")->where('gos_paq_servicio_id','>',0)->get();
              $servicios=Gos_Paq_Servicio::where('gos_taller_id',$idtaller)->whereIn('gos_paq_servicio_id', $NserviciosACtive)->get();
              $ITemsOS=Gos_V_Os_Items::where('gos_taller_id',$idtaller)->where('estado_etapa','=',"A")->where('gos_paq_servicio_id','>',0)->get();
              $tecnicos=Gos_V_Usuarios::where('gos_taller_id',$idtaller)->where('gos_usuario_rol_id',2)->get();

              $month = date("F", strtotime('m'));

              $creadasMes = null;
              $final=[];
              $arrays=[];
              $creacionar  =[];
              $terminadoar = [];
              $entregadoar = [];
              $design_id = 'Valuacion Web';
              $list_desings_ids = array('hc1wXBL7zCsdfMu','dhdsfHddfD','otheridshere');
              $etapas = Gos_V_Inicio_Os_Etapas::
              leftJoin('gos_os', 'gos_os.gos_os_id', '=', 'gos_v_inicio_os_etapas.gos_os_id')
              ->where('gos_v_inicio_os_etapas.gos_taller_id',Session::get('taller_id'))
              ->whereNull('fecha_cancelado')
              ->whereNull('deleted_at')
              ->groupBy('gos_paq_etapa_id')
              ->groupBy('gos_os.gos_os_id')
              ->orderBy('orden_etapa')
              ->get();

              foreach($etapas as $object)
              {
                  $arrays[] =  $object->nomb_etapa.'-'.$object->estado_etapa.'-'.$object->tipo;
              }

              $counts = array_count_values($arrays);
              foreach($counts as $key =>$count){
                  $exploded = explode('-',$key);               
                  if($exploded[1] == 'A'){
                      $final[] = ['nomb_etapa'=>$exploded[0],'cuenta'=>$count,'tipo'=>$exploded[2]];
                  }
                  
              }

              
              $creadasMes = Gos_V_Inicio_Creadas::where('gos_taller_id',Session::get('taller_id'))->get();
              foreach($creadasMes as $object)
              {
                  $creacionar[] =  $object->fecha_creacion_os;
                  $terminadoar[] =  $object->fecha_terminado;
                  $entregadoar[] =  $object->fecha_entregado;
              }
              $idtaller=Session::get('taller_id');
              $count = Gos_V_Os::where('gos_taller_id',Session::get('taller_id'))->count();
              $os = DB::select( DB::raw("SELECT *
              FROM gos_v_inicio_calendario
             WHERE  gos_taller_id=".$idtaller." AND fecha_terminado is null and fecha_entregado is null
              GROUP BY gos_os_id
             ORDER BY nro_orden_interno ASC"));

              //$os = Gos_V_Os::where('gos_taller_id',Session::get('taller_id'))->get();
              $creacion = array_count_values ( array_filter($creacionar));
              $terminado =array_count_values ( array_filter($terminadoar));
              $entregado =array_count_values ( array_filter($entregadoar));
              $numcreacion = isset($creacion[$month]) ? $creacion[$month]: 0;
              $numentregado = isset($entregado[$month]) ? $entregado[$month]: 0;
              $numterminado = isset($terminado[$month]) ? $terminado[$month] -$numentregado  :0;
              $numproceso = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_entregado')->count();


              $numrealterminado = isset($terminado[$month]) ? $terminado[$month]: 0;

              if($month == 'January' ){$month='Enero';}
              if($month == 'February' ){$month='Febrero';}
              if($month == 'March' ){$month='Marzo';}
              if($month == 'April' ){$month='Abril';}
              if($month == 'May' ){$month='Mayo';}
              if($month == 'June' ){$month='Junio';}
              if($month == 'July' ){$month='Julio';}
              if($month == 'August' ){$month='Agosto';}
              if($month == 'September' ){$month='Septiembre';}
              if($month == 'October' ){$month='Octubre';}
              if($month == 'November' ){$month='Noviembre';}
              if($month == 'December' ){$month='Diciembre';}
              $compact = compact('numcreacion','numterminado','numentregado','numproceso','numrealterminado', 'os', 'count', 'final','servicios','ITemsOS','seracTec','tecnicos','month','taller_conf_vehiculo','taller_conf_ase');
              //return $compact;

        //$compact = $this->preparaCrearEditar();

        return view($this->getVistaListado(), $compact);

    }


    public function consultarBD(Request $request)//retorna datos para el side menu
    {
      $usuario=Session::get('usr_Data');
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      return(compact('taller_conf_vehiculo'));
    }

    protected function preparaCrearEditar()
    {
        $creadasMes = null;
        $final=[];
        $arrays=[];
        $creacionar  =[];
        $terminadoar = [];
        $entregadoar = [];
        $design_id = 'Valuacion Web';
        $list_desings_ids = array('hc1wXBL7zCsdfMu','dhdsfHddfD','otheridshere');
        $etapas = Gos_V_Inicio_Os_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();
        foreach($etapas as $object)
        {
            $arrays[] =  $object->nomb_etapa.'-'.$object->estado_etapa;
        }
        $counts = array_count_values($arrays);
        foreach($counts as $key =>$count){
            $exploded = explode('-',$key);
            if($exploded[1] == 'A'){
                $final[] = ['nomb_etapa'=>$exploded[0],'cuenta'=>$count];
            }

        }
        
        $creadasMes = Gos_V_Inicio_Creadas::where('gos_taller_id',Session::get('taller_id'))->get();
        foreach($creadasMes as $object)
        {
            $creacionar[] =  $object->fecha_creacion_os;
            $terminadoar[] =  $object->fecha_terminado;
            $entregadoar[] =  $object->fecha_entregado;
        }
        $count = Gos_V_Os::where('gos_taller_id',Session::get('taller_id'))->count();
        $os = Gos_V_Os::where('gos_taller_id',Session::get('taller_id'))->get();
        $creacion = array_count_values ( array_filter($creacionar));
        $terminado =array_count_values ( array_filter($terminadoar));
        $entregado =array_count_values ( array_filter($entregadoar));
        $numcreacion = isset($creacion['January']) ? $creacion['January']: 0;
        $numentregado = isset($entregado['January']) ? $entregado['January']: 0;
        $numterminado = isset($terminado['January'])  -$numentregado;
        $numproceso = $numcreacion - $numterminado -$numentregado;


        $compact = compact('numcreacion','numterminado','numentregado','numproceso', 'os', 'count', 'final');
        return $compact;
    }





    protected function preparaDataTableCalendario($fecha_promesa_os)
    {
        $fecha_fin = date("Y-m-d",strtotime($fecha_promesa_os.' + 1 days'));

        $fecha_promesa_os =  date("Y-m-d",strtotime($fecha_promesa_os));
        $idtaller=Session::get('taller_id');
        $fecha = DB::select( DB::raw("SELECT *
        FROM gos_v_inicio_calendario
       WHERE  gos_taller_id=".$idtaller." AND fecha_promesa_os >= '".$fecha_promesa_os."' AND fecha_promesa_os <= '".$fecha_fin."' AND fecha_terminado is null and fecha_entregado is null
       GROUP BY gos_os_id
       ORDER BY nro_orden_interno ASC"));

        // $fecha = Gos_V_Inicio_Calendario::where('fecha_promesa_os','>=',$fecha_promesa_os)->where('fecha_promesa_os','<=',$fecha_fin)->where('gos_taller_id',Session::get('taller_id'))->get();
        $ajax = $this->preparaDataTableAjax($fecha, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }

    }
    protected function preparaDataTableOrdenes($id){
        $xpl = explode("-", $id);
        $idd = $xpl[0];

        if($xpl[1] != ''){
          $tipo = $xpl[1];
          $idtaller=Session::get('taller_id');
          $fecha = DB::select( DB::raw("SELECT gvic.* ,goi.gos_os_item_id,gvoem.tiempo_meta_texto,gvoem.fecha_inicio_et,gvoem.tiempo_meta_calculado,gvoem.nombre
          from gos_v_os_etapas_mod as gvoem
            LEFT JOIN gos_v_inicio_calendario as gvic ON gvic.gos_os_id = gvoem.gos_os_id  
            inner JOIN gos_os_item as goi ON goi.gos_os_id = gvic.gos_os_id  
                where gvoem.gos_taller_id = ".$idtaller." AND gvoem.estado_etapa='A' AND tipo = $tipo  AND gvoem.nombre='".$idd."' and gvic.fecha_cancelado is null 
                GROUP BY gvic.gos_os_id
          ORDER BY gvic.nro_orden_interno ASC" ));
        }
        else{
          $idtaller=Session::get('taller_id');
          $fecha = DB::select( DB::raw("SELECT gvic.* ,goi.gos_os_item_id,gvoem.tiempo_meta_texto,gvoem.fecha_inicio_et,gvoem.tiempo_meta_calculado,gvoem.nombre
          from gos_v_os_etapas_mod as gvoem
            LEFT JOIN gos_v_inicio_calendario as gvic ON gvic.gos_os_id = gvoem.gos_os_id  
            inner JOIN gos_os_item as goi ON goi.gos_os_id = gvic.gos_os_id  
                where gvoem.gos_taller_id = ".$idtaller." AND gvoem.estado_etapa='A' AND gvoem.nombre='".$idd."' and gvic.fecha_cancelado is null 
                GROUP BY gvic.gos_os_id
          ORDER BY gvic.nro_orden_interno ASC" ));
        }
   



        // $fecha = Gos_V_Os_Items::where('gos_taller_id',Session::get('taller_id'))->where('nombre', $id)->where('estado_etapa', 'A')->get();
        $ajax = $this->preparaDataTableAjax($fecha, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
    }

   public function preparaDataTableervicio($nomtec,$idser){
    $idtaller=Session::get('taller_id');
    //    $ITemsOS=Gos_V_Os_Items::where('gos_taller_id',$idtaller)->where('estado_etapa','=',"A")->where('gos_paq_servicio_id','=',$idser)->where('tecnico','=',$nomtec)->get();
    $ITemsOS = DB::select( DB::raw("SELECT CONCAT(IFNULL(fecha_inicio_et,''),'|',IFNULL(DATE_ADD(fecha_inicio_et, INTERVAL tiempo_meta_segundos SECOND),''),'|', IFNULL(fecha_promesa_os,'')) as fecha_fin_etapa ,d.*, g.*
    FROM gos_v_os_etapas  d
    INNER JOIN gos_v_inicio_calendario g ON d.gos_os_id = g.gos_os_id
    WHERE tecnico_nueva = '".$nomtec."'   AND d.estado_etapa = 'A' AND d.gos_taller_id = ".$idtaller." AND gos_paq_servicio_id = '".$idser."' AND gos_paq_servicio_id > 0
    GROUP BY d.gos_os_id" ));
     $ajax = $this->preparaDataTableAjax($ITemsOS, $this->getOpcionesEditDataTable());
     if (null != $ajax) {
         return $ajax;
     }
   }
}
