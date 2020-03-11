<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_V_Os_Mensajes;
// use App\Gos\Gos_Nomina;

class ReporteSeguimientoClienteController extends ReportesMasterController
{
    public function index()
    {
        $fechamin = date('m/01/Y'); 
        $fechamax = date("m/t/Y");
        $fechaRango = $fechamin.' - '.$fechamax;

        $fecha_inicio = date('Y/m/01'); 
        $fecha_fin = date('Y/m/t'); 

        $idtaller=Session::get('taller_id');
        $listadoMensajes = DB::select(DB::raw(
            "SELECT M.gos_os_id,O.nro_orden_interno,
                CAST(O.fecha_ingreso_v_os AS date) as fecha_ingreso_v_os,
                CAST(O.fecha_creacion_os AS date) as fecha_creacion_os,
                O.gos_cliente_id,
                O.nomb_cliente,
                O.detallesVehiculo,
                count(gos_os_mensaje_id) as cantidad
            FROM gos_os_mensaje M inner join gos_v_os O on M.gos_os_id = O.gos_os_id
            WHERE M.visble = 1 AND O.gos_taller_id = '".$idtaller."'
            AND fecha_creacion_os BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'
            GROUP BY M.gos_os_id,O.nro_orden_interno,CAST(O.fecha_ingreso_v_os AS date),
            CAST(O.fecha_creacion_os AS date),O.gos_cliente_id,O.nomb_cliente,O.detallesVehiculo"
        ));

        return view('/Reportes/ReporteSeguimientoCliente',compact('listadoMensajes','fechaRango'));

    }

    public function indexFiltros(Request $request)
    {       
        $fechaRango = $request->rangoFechas;

        $fechaSplit = explode(" - ",$request->rangoFechas);
        $fecha_inicio = date("Y-m-d",strtotime($fechaSplit[0]));
        $fecha_fin = date("Y-m-d",strtotime($fechaSplit[1]));

        $idtaller=Session::get('taller_id');
        $listadoMensajes = DB::select(DB::raw(
            "SELECT M.gos_os_id,O.nro_orden_interno,
                CAST(O.fecha_ingreso_v_os AS date) as fecha_ingreso_v_os,
                CAST(O.fecha_creacion_os AS date) as fecha_creacion_os,
                O.gos_cliente_id,
                O.nomb_cliente,
                O.detallesVehiculo,
                count(gos_os_mensaje_id) as cantidad
            FROM gos_os_mensaje M inner join gos_v_os O on M.gos_os_id = O.gos_os_id
            WHERE M.visble = 1 AND O.gos_taller_id = '".$idtaller."'
            AND CAST(O.fecha_creacion_os AS date) BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'
            GROUP BY M.gos_os_id,O.nro_orden_interno,CAST(O.fecha_ingreso_v_os AS date),
            CAST(O.fecha_creacion_os AS date),O.gos_cliente_id,O.nomb_cliente,O.detallesVehiculo"
        ));

        return view('/Reportes/ReporteSeguimientoCliente',compact('listadoMensajes','fechaRango'));
    }

    public function clientesMensajes($gos_os_id){
        $listaServicios = Gos_V_Os_Mensajes::where('gos_os_id',$gos_os_id)->where('visble',1)->get();

        $ajax = $this->preparaDataTableAjax($listaServicios, '');
        return $ajax;
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
