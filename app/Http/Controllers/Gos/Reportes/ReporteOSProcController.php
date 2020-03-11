<?php
namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;
use App\GosClases\GosUtil;
use App\Gos\Gos_OS;
use App\Gos\Gos_V_Inicio_Calendario;
use App\Gos\Gos_V_Reporte_Orden_Servicio; // COMPLETO
use App\Gos\Gos_V_Reporte_Orden_Servicio_X_Fecha; // PARA TABLA
use Session;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_ase;
use \Response;

/**
 * deriva de Controller o de GosControllers
 *
 * @author yois
 *
 */
class ReporteOSProcController extends ReportesMasterController
{
    protected $vistaListado = '/Reportes/ReporteOrdenServicio';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        parent::index();
        $compact_padre = $this->getCompact();
        $firstday=date('Y-m-01');
        $lastday=date('Y-m-t');

        $fechamin =  date('Y-m-01'); 
        $fechamax = date("Y-m-t");
        $idtaller=Session::get('taller_id');
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $listadoTabla = Gos_V_Reporte_Orden_Servicio_X_Fecha::where('gos_taller_id',$idtaller)
                                                        ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                                        ->get();
        $fecha1 = date("m/01/Y");
        $fecha2 = date('m/t/Y'); 
        $fechaRango = $fecha1.' - '.$fecha2;
        // $ajax = $this->preparaDataTableAjax($listadoTabla,'');
        // if (null !== $ajax) {
        //     return $ajax;
        // }

        return view($this->getVistaListado(), $compact_padre)->with(compact('taller_conf_ase','listadoTabla','fechaRango'));
    }

    public function graficoA(){
        $fechamin =  date('Y-m-01');
        $fechamax = date("Y-m-t");
        $idtaller=Session::get('taller_id');
        $listadoTabla = Gos_V_Reporte_Orden_Servicio_X_Fecha::where('gos_taller_id',$idtaller)
                                                            ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                                            ->get();
        return $listadoTabla;                                            
    }

    public function setTabla(Request $request)
    {
        $fechamin = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,0,10))) : date('Y-m-01');
        $fechamax = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,14,10))) : date("Y-m-t");      

        $aseguradora = $request->gos_aseguradora_id;
        $tipoOrden = $request->gos_os_tipo_o_id;
        $tipoDanio = $request->gos_os_tipo_danio_id;
        $tipoEstado = $request->gos_os_estado_exp_id;
        
        $idtaller=Session::get('taller_id');
        $tabla = Gos_V_Reporte_Orden_Servicio::select('gos_taller_id','fechaCreacion')
                                                ->selectRaw('sum(cantfechaCreacion) as cantfechaCreacion')
                                                ->selectRaw('sum(cantfechaIngreso) as cantfechaIngreso')
                                                ->selectRaw('sum(cantfechaTerminado) as cantfechaTerminado')
                                                ->selectRaw('sum(cantfechaEntregado) as cantfechaEntregado')
                                                ->selectRaw('sum(cantfechaFacturado) as cantfechaFacturado')
                                                ->selectRaw('sum(cantfechaRemision) as cantfechaRemision')
                                                ->selectRaw('sum(SaldoFacturado) as SaldoFacturado')
                                                ->selectRaw('sum(SaldoRemision) as SaldoRemision')
                                                ->selectRaw('sum(SaldoCredito) as SaldoCredito')
                                                ->selectRaw('sum(SaldoContado) as SaldoContado')
                                                ->where('gos_taller_id',$idtaller)
                                                ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                                ->FilterAseguradora($aseguradora)
                                                ->FilterTipoDanio($tipoDanio)
                                                ->FilterTipoOrden($tipoOrden)
                                                ->FilterEstado($tipoEstado)
                                                ->groupBy('gos_taller_id','fechaCreacion')
                                                ->orderBy('fechaCreacion', 'asc')
                                                ->get();
        return Response::json($tabla);
    }    
        
    public function preparaDataTableOrdenes(Request $request)
    {
        $idtaller=Session::get('taller_id');
        $fecha = date("Y-m-d H:i:s", strtotime($request->Fecha));
        $fechaMax = date("Y-m-d H:i:s", strtotime('+59 second',strtotime('+59 minute', strtotime('23 hour',strtotime($request->Fecha)))));

        $fecha_creacion_os=null;
        $fecha_ingreso_v_os=null;
        $fecha_terminado=null;
        $fecha_entregado=null;
        $fecha_facturado=null;
        $fecha_remision=null;

        if($request->Estado=='creacion'){
            $fecha_creacion_os=$fecha;
        } else if($request->Estado=='ingreso'){
            $fecha_ingreso_v_os=$fecha;
        } else if($request->Estado=='terminado'){
            $fecha_terminado=$fecha;
        } else if($request->Estado=='entregado'){
            $fecha_entregado=$fecha;
        } else if($request->Estado=='facturado'){
            $fecha_facturado=$fecha;
        } else if($request->Estado=='remision'){
            $fecha_remision=$request->Fecha;
        } 

        if(isset($fecha_remision)){
            // $tabla = null;

            $tabla = Gos_V_Inicio_Calendario::where('gos_taller_id',$idtaller)
                                            ->FilterFechaRemision($fecha_remision)
                                            ->FilterAseguradora($request->Aseguradora)
                                            ->FilterTipoDanio($request->TipoDanio)
                                            ->FilterTipoOrden($request->TipoOrden)
                                            ->FilterEstado($request->TipoEstado)
                                            ->get();

        }else {
            $tabla = Gos_V_Inicio_Calendario::where('gos_taller_id',$idtaller)
                                            ->FilterAseguradora($request->Aseguradora)
                                            ->FilterTipoDanio($request->TipoDanio)
                                            ->FilterTipoOrden($request->TipoOrden)
                                            ->FilterEstado($request->TipoEstado)
                                            ->FilterFechaCreacion($fecha_creacion_os,$fechaMax)
                                            ->FilterFechaIngreso($fecha_ingreso_v_os,$fechaMax)
                                            ->FilterFechaTerminado($fecha_terminado,$fechaMax)
                                            ->FilterFechaEntregado($fecha_entregado,$fechaMax)
                                            ->FilterFechaFacturado($fecha_facturado,$fechaMax)
                                            ->get();
        }
        
        return Response::json($tabla);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
