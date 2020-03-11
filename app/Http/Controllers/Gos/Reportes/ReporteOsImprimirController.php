<?php

namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;
use App\GosClases\GosUtil;
use Session;
use \Response;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Os_Ligadas;

class ReporteOsImprimirController extends ReportesMasterController
{
    public function index()
    {
        $idtaller=Session::get('taller_id');
        
        $OSProceso = DB::select(DB::raw(
        "SELECT C.gos_taller_id,
                C.gos_os_id,
                CASE WHEN C.fecha_terminado IS NULL AND C.fecha_historico IS NULL AND C.fecha_cancelado IS NULL THEN 'enProceso'
                    WHEN C.fecha_terminado IS NOT NULL AND C.fecha_historico IS NULL AND C.fecha_entregado IS NULL 
                        AND C.fecha_cancelado IS NULL THEN 'terminada'
                    WHEN C.fecha_terminado IS NOT NULL AND C.fecha_entregado IS NOT NULL AND C.fecha_facturado IS NULL 
                        AND C.fecha_historico IS NULL AND C.fecha_cancelado IS NULL THEN 'entregada'
                    WHEN C.fecha_facturado IS NOT NULL OR C.fecha_historico IS NOT NULL THEN 'historico'
                    WHEN C.fecha_cancelado IS NOT NULL AND C.fecha_historico IS NULL THEN 'cancelada'
                END as Carpeta,
                C.fecha_creacion_os,
                C.fecha_ingreso_v_os,
                C.fecha_promesa_os,
                CASE WHEN C.fecha_promesa_os = '0000-00-00 00:00:00' THEN 'Sin Fecha'
                    WHEN CAST(C.fecha_promesa_os as DATE) - CURDATE() < 0 THEN 'Rojo'
                    WHEN CAST(C.fecha_promesa_os as DATE) - CURDATE() <= 2 THEN 'Amarillo'
                    ELSE 'Verde' END AS EstadoFechaPromesa,
                C.fecha_terminado,
                C.fecha_entregado,
                C.fecha_facturado,
                C.nro_orden_interno,
                C.porcentaje,
                C.nomb_etapa,
                tipoo.tipo_orden,
                este.estado_expediente,
                tipod.tipo_danio,
                riesg.nomb_riesgo,
                A.empresa,
                C.nro_reporte,
                C.nro_poliza,
                OS.nro_orden,
                C.demerito,
                C.deducible,
                VH.nombre_cliente,
                VH.MarcaVehiculo,
                VH.ModeloVehiculo,
                VH.anio_vehiculo,
                VH.placa,
                VH.colorVehiculo,
                VH.economico,
                VH.nro_serie,
                C.asesor,
                (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as Total,
                C.fecha_pago,
                '' as Pagos,
                C.dias,
                C.nomb_aseguradora,
                C.detallesVehiculo
        FROM gos_v_inicio_calendario C
        LEFT JOIN (SELECT gos_os_id,SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                                    SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total
                    FROM gos_os_item GROUP BY gos_os_id) as T ON C.gos_os_id = T.gos_os_id
        LEFT JOIN gos_v_vehiculos VH ON C.gos_vehiculo_id = VH.gos_vehiculo_id
        LEFT JOIN gos_os OS ON C.gos_os_id = OS.gos_os_id
        LEFT JOIN gos_aseguradora A ON C.gos_aseguradora_id = A.gos_aseguradora_id
        LEFT JOIN gos_os_tipo_o tipoo ON C.gos_os_tipo_o_id = tipoo.gos_os_tipo_o_id
        LEFT JOIN gos_os_estado_exp este ON C.gos_os_estado_exp_id = este.gos_os_estado_exp_id
        LEFT JOIN gos_os_tipo_danio tipod ON C.gos_os_tipo_danio_id = tipod.gos_os_tipo_danio_id
        LEFT JOIN gos_os_riesgo riesg ON C.gos_os_riesgo_id = riesg.gos_os_riesgo_id
        WHERE C.gos_taller_id='".$idtaller."'
        GROUP BY C.gos_os_id"
        ));

        $fechaminR = date('m/d/Y',strtotime('first day of January', time())); 
        $fechamaxR = date("m/t/Y");
        $fechaRango = $fechaminR.' - '.$fechamaxR;

        $osLigadas=Gos_Os_Ligadas::all();

        return view('/Reportes/ReporteOsImprimir',compact('OSProceso','idtaller','fechaRango','osLigadas'));
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
