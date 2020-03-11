<?php
namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;
use GosClases\ReporteUtilidadUnidad;
use App\GosClases\GosUtil;
use App\Gos\Gos_V_Reporte_Utilidad;
use App\Gos\Gos_V_Reporte_Utilidad_Completo;
use \Response;
use Session;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;


class ReporteUtilidadController extends ReportesMasterController
{
    public function index()
    {
        parent::index();     

        $fechamin =  date('Y-m-01');
        $fechamax = date("Y-m-t");
        $idtaller=Session::get('taller_id');
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();

        $compact = $this->getCompact();
        //$opcionesEditDataTable = 'Reportes.ReporteUtilidadOpciones';

        $listadoTabla = Gos_V_Reporte_Utilidad::where('gos_taller_id',$idtaller)
                                            ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                            ->get();
        // $ajax = $this->preparaDataTableAjax($listadoTabla,'');
        // if (null !== $ajax) {
        //     return $ajax;
        // }

        $fecha1 = date("m/01/Y");
        $fecha2 = date('m/t/Y'); 
        $fechaRango = $fecha1.' - '.$fecha2;

        return view('/Reportes/ReporteUtilidadUnidad', $compact)->with(compact('taller_conf_vehiculo','taller_conf_ase','listadoTabla','fechaRango'));
    }

    public function graficoA(){
        $fechamin =  date('Y-m-01');
        $fechamax = date("Y-m-t");
        $idtaller=Session::get('taller_id');
        $listadoTabla = Gos_V_Reporte_Utilidad::where('gos_taller_id',$idtaller)
                                            ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                            ->get();
        return $listadoTabla;                                            
    }

    public function setTabla(Request $request)
    {
        $fechamin = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,0,10))) : date('Y-m-01');
        $fechamax = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,14,10))) : date("Y-m-t");      

        $aseguradora = $request->aseguradora;
        $tipoOrden = $request->tipo_orden;
        // $item = $request->item;
        $global = $request->global_filtro;
        
        $idtaller=Session::get('taller_id');
        $tabla = Gos_V_Reporte_Utilidad::where('gos_taller_id',$idtaller)
                                                ->whereBetween('fechaCreacion',[$fechamin,$fechamax])
                                                ->FilterGlobal($global)
                                                ->FilterAseguradora($aseguradora)
                                                ->FilterTipoOrden($tipoOrden)
                                                ->get();        
        
        return Response::json($tabla);
    }

    public function detallesOs($gos_os_id)
    {        
        $idtaller=Session::get('taller_id');
        $tabla = Gos_V_Reporte_Utilidad_Completo::where('gos_taller_id',$idtaller)
                                        ->where('gos_os_id',$gos_os_id)
                                        ->orderby('Descripcion','desc')
                                        ->get();        
        
        return Response::json($tabla);
    } 

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
