<?php

namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use \Response;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;


class ReporteOSTecnicos extends ReportesMasterController
{
    public function index()
    {
        $idtaller=Session::get('taller_id');
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $listaTecnicos = DB::select(DB::raw(
            " SELECT CONCAT(U.nombre,' ',U.apellidos) as nombre, U.gos_usuario_id
                FROM gos_usuario U 
                LEFT JOIN gos_usuario_perfil P on U.gos_usuario_perfil_id = P.gos_usuario_perfil_id
                LEFT JOIN gos_lic_taller_usuario TU ON U.gos_usuario_id = TU.gos_usuario_id
                WHERE P.gos_usuario_rol_id = 2 AND TU.gos_taller_id = ".$idtaller
        ));

        $fechamin = date('Y-m-01'); 
        $fechamax = date("Y-m-t");
        $listaAsignadas = DB::select(DB::raw(
            "SELECT gos_taller_id, 
                    gos_usuario_id,
                    nombre,
                    nomb_perfil,
                    count(gos_os_id) as asignadas,
                    sum(case when fechaCierreEtapa is not null then 1 else 0 end) as terminadas,
                    sum(case when fechaCierreEtapa is not null and Saldo = 0 and total <> 0 then 1 else 0 end) as pagadas,
                    sum(case when fechaCierreEtapa is not null and Saldo <> 0 then 1 else 0 end) as pendientesPago
            FROM gos_v_reporte_orden_por_tecnico
            WHERE gos_taller_id = '".$idtaller."' 
            AND fechaOs >= '".$fechamin."' AND fechaOs <= '".$fechamax."'
            GROUP BY  gos_taller_id,gos_usuario_id,nombre,nomb_perfil"
        ));

        $fechaminR = date('m/01/Y'); 
        $fechamaxR = date("m/t/Y");
        $fechaRango = $fechaminR.' - '.$fechamaxR;

        return view('Reportes/ReporteOsTecnicos',compact('listaTecnicos','listaAsignadas','fechaRango','taller_conf_ase','taller_conf_vehiculo'));
    }

    public function setTabla($fechas)
    {
        $fechamin = date("Y-m-d", strtotime(substr($fechas,0,10)));
        $fechamax = date("Y-m-d", strtotime(substr($fechas,11,10)));

        $idtaller=Session::get('taller_id');

        $listaAsignadas = DB::select(DB::raw(
            "SELECT gos_taller_id, 
                    gos_usuario_id,
                    nombre,
                    nomb_perfil,
                    count(gos_os_id) as asignadas,
                    sum(case when fechaCierreEtapa is not null then 1 else 0 end) as terminadas,
                    sum(case when fechaCierreEtapa is not null and Saldo = 0 and total <> 0 then 1 else 0 end) as pagadas,
                    sum(case when fechaCierreEtapa is not null and Saldo <> 0 then 1 else 0 end) as pendientesPago
            FROM gos_v_reporte_orden_por_tecnico
            WHERE gos_taller_id = '".$idtaller."' 
            AND fechaOs >= '".$fechamin."' AND fechaOs <= '".$fechamax."'
            GROUP BY  gos_taller_id,gos_usuario_id,nombre,nomb_perfil"
        ));

        $ajax = $this->preparaDataTableAjax($listaAsignadas,'');
        
        return $ajax;
    }

    public function ordenes($datos)
    {   
        $idtaller=Session::get('taller_id');
        
        $corte=explode("|", $datos);
        $tipo = $corte[0];
        $gos_usuario_id = $corte[1];
        $fecha1 =$corte[2];
        $fecha2 =$corte[3];

        $listaOs = null;
        if ($tipo == 'Asignada') {
            $listaOs = DB::select(DB::raw("SELECT O.gos_usuario_id,O.gos_os_id,O.gos_taller_id,C.nro_orden_interno,
                                            C.nomb_cliente,C.nomb_aseguradora_min,C.detallesVehiculo,O.total,O.Pago,O.Saldo,
                                            CAST(C.fecha_creacion_os as DATE) as FechaCreacionOS,
                                            if(C.fecha_terminado is null,'En Proceso','Terminada') as EstadoOS,
                                            if(O.fechaCierreEtapa is null,'Pendiente','Terminada') as EstadoEtapa,
                                            if(O.saldo = '0.00','Pagada','Pendiente') as EstadoPago,
                                            POR.porcentaje AS porcentaje,
                                            C.fecha_terminado AS fecha_terminado,
                                            C.fecha_entregado AS fecha_entregado
                                        FROM gos_v_reporte_orden_por_tecnico O 
                                        LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
                                        LEFT JOIN gos_v_inicio_etapa_porcentaje POR ON O.gos_os_id = POR.gos_os_id
                                        WHERE O.gos_usuario_id = '".$gos_usuario_id."'
                                        AND CAST(C.fecha_creacion_os as DATE) >=  '".$fecha1."' 
                                        AND CAST(C.fecha_creacion_os as DATE) <=  '".$fecha2."' 
                                        AND O.gos_taller_id = ".$idtaller));}
        else if($tipo == 'Terminadas'){
            $listaOs = DB::select(DB::raw("SELECT O.gos_usuario_id,O.gos_os_id,O.gos_taller_id,C.nro_orden_interno,
                                            C.nomb_cliente,C.nomb_aseguradora_min,C.detallesVehiculo,O.total,O.Pago,O.Saldo,
                                            CAST(C.fecha_creacion_os as DATE) as FechaCreacionOS,
                                            if(C.fecha_terminado is null,'En Proceso','Terminada') as EstadoOS,
                                            if(O.fechaCierreEtapa is null,'Pendiente','Terminada') as EstadoEtapa,
                                            if(O.saldo = '0.00','Pagada','Pendiente') as EstadoPago,
                                            POR.porcentaje AS porcentaje,
                                            C.fecha_terminado AS fecha_terminado,
                                            C.fecha_entregado AS fecha_entregado
                                        FROM gos_v_reporte_orden_por_tecnico O 
                                        LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
                                        LEFT JOIN gos_v_inicio_etapa_porcentaje POR ON O.gos_os_id = POR.gos_os_id
                                        WHERE O.fechaCierreEtapa is not null 
                                        AND O.gos_usuario_id = '".$gos_usuario_id."'
                                        AND CAST(C.fecha_creacion_os as DATE) >=  '".$fecha1."' 
                                        AND CAST(C.fecha_creacion_os as DATE) <=  '".$fecha2."'  
                                        AND O.gos_taller_id = ".$idtaller));}
        else if($tipo == 'Pagadas'){
            $listaOs = DB::select(DB::raw("SELECT O.gos_usuario_id,O.gos_os_id,O.gos_taller_id,C.nro_orden_interno,
                                            C.nomb_cliente,C.nomb_aseguradora_min,C.detallesVehiculo,O.total,O.Pago,O.Saldo,
                                            CAST(C.fecha_creacion_os as DATE) as FechaCreacionOS,
                                            if(C.fecha_terminado is null,'En Proceso','Terminada') as EstadoOS,
                                            if(O.fechaCierreEtapa is null,'Pendiente','Terminada') as EstadoEtapa,
                                            if(O.saldo = '0.00','Pagada','Pendiente') as EstadoPago,
                                            POR.porcentaje AS porcentaje,
                                            C.fecha_terminado AS fecha_terminado,
                                            C.fecha_entregado AS fecha_entregado
                                        FROM gos_v_reporte_orden_por_tecnico O 
                                        LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
                                        LEFT JOIN gos_v_inicio_etapa_porcentaje POR ON O.gos_os_id = POR.gos_os_id
                                        WHERE O.fechaCierreEtapa is not null
                                        AND O.saldo = '0.00' 
                                        and O.total <> '0.00' 
                                        AND O.gos_usuario_id = '".$gos_usuario_id."'
                                        AND CAST(C.fecha_creacion_os as DATE) >=  '".$fecha1."' 
                                        AND CAST(C.fecha_creacion_os as DATE) <=  '".$fecha2."'  
                                        AND O.gos_taller_id = ".$idtaller));}
        else {$listaOs = DB::select(DB::raw("SELECT O.gos_usuario_id,O.gos_os_id,O.gos_taller_id,C.nro_orden_interno,
                                            C.nomb_cliente,C.nomb_aseguradora_min,C.detallesVehiculo,O.total,O.Pago,O.Saldo,
                                            CAST(C.fecha_creacion_os as DATE) as FechaCreacionOS,
                                            if(C.fecha_terminado is null,'En Proceso','Terminada') as EstadoOS,
                                            if(O.fechaCierreEtapa is null,'Pendiente','Terminada') as EstadoEtapa,
                                            if(O.saldo = '0.00','Pagada','Pendiente') as EstadoPago,
                                            POR.porcentaje AS porcentaje,
                                            C.fecha_terminado AS fecha_terminado,
                                            C.fecha_entregado AS fecha_entregado
                                        FROM gos_v_reporte_orden_por_tecnico O 
                                        LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
                                        LEFT JOIN gos_v_inicio_etapa_porcentaje POR ON O.gos_os_id = POR.gos_os_id
                                        WHERE O.fechaCierreEtapa is not null
                                        AND O.saldo <> '0.00'
                                        AND O.gos_usuario_id = '".$gos_usuario_id."' 
                                        AND CAST(C.fecha_creacion_os as DATE) >=  '".$fecha1."' 
                                        AND CAST(C.fecha_creacion_os as DATE) <=  '".$fecha2."' 
                                        AND O.gos_taller_id = ".$idtaller));}

        $ajax = $this->preparaDataTableAjax($listaOs,'');
        
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
