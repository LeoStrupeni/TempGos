<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Nomina;
use App\Gos\Gos_Nomina_Pagos;
use App\Gos\Gos_Prestamo;
use App\Gos\Gos_Prestamo_Pagos;
use App\Gos\Gos_V_Prestamos;
use App\Gos\Gos_V_Prestamos_Pagos;

class ReporteNominaController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $idtaller=Session::get('taller_id');
        $listaReportesNomina = DB::select(DB::raw(
            "SELECT G.gos_taller_id,
                    G.gos_nomina_id,
                    G.gos_usuario_id,
                    cast(G.fecha_nomina as date) as fecha_nomina, 
                    G.tipo_pago,
                    G.observaciones,
                    CONCAT(U.nombre,' ',U.apellidos) as nombre,
                    I.total 
            FROM gos_nomina G
            LEFT JOIN gos_usuario U ON G.gos_usuario_id = U.gos_usuario_id
            LEFT JOIN (SELECT gos_nomina_id,sum(monto_Total) AS total FROM gos_nomina_pagos GROUP BY gos_nomina_id) I ON G.gos_nomina_id = I.gos_nomina_id
            WHERE G.gos_taller_id = ".$idtaller
        ));

        return view('/Reportes/ReporteNomina',compact('listaReportesNomina'));
    }
  
    public function crearReporte(){
        $idtaller=Session::get('taller_id');
       
        if (date("D")=="Mon"){
            $fecha_inicio = date("Y-m-d");
            $fechamin = date('m/d/Y'); 
        } else {
            $fecha_inicio = date("Y-m-d", strtotime('last Monday', time()));
            $fechamin = date('m/d/Y', strtotime('last Monday', time())); 
        }
        $fecha_fin = date("Y-m-d",strtotime('next Sunday', time()));
        $fechamax = date("m/d/Y",strtotime('next Sunday', time()));
        
        $listadoNomina = DB::select(
            DB::raw("SELECT U.gos_taller_id,U.gos_usuario_id,U.nombre,U.rol,U.nomb_rol,
                            (U.sueldo * ifnull(TS.semana,1)) as Sueldo, 
                            ifnull(PA.Pago,0) as SueldoPago,
                            (U.sueldo * ifnull(TS.semana,1)) - ifnull(PA.Pago,0) as SueldoPendiente,
                            ifnull(PRES.prestamo,0) as PrestamoTotal,
                            ifnull(PRES.pagado,0) as PrestamoPago,
                            ifnull(PRES.saldo,0) as PrestamoPendiente,
                            ifnull(OS.servicios,0) as Servicios,
                            ifnull(OS.comision,0) as Comision,
                            ifnull(OS.materiales,0) as materiales,
                            ifnull(OS.desc_materiales,0) as desc_materiales,
                            ifnull(OS.total,0) as Total,
                            ifnull(OS.Pago,0) as Pago
                    FROM gos_v_reporte_nomina_sueldos U 
                    
                    LEFT JOIN (SELECT gos_usuario_id,
                                TIMESTAMPDIFF(day,  '".$fecha_inicio."', '".$fecha_fin."') as dias,
                                ROUND(TIMESTAMPDIFF(day,  '".$fecha_inicio."', '".$fecha_fin."') / 7,0) as semana
								FROM gos_v_reporte_nomina_sueldos
                                WHERE gos_taller_id = '".$idtaller."') TS 
					ON U.gos_usuario_id = TS.gos_usuario_id

                    LEFT JOIN (SELECT gos_usuario_id, fecha_pago,
                                SUM(monto_Total) as Pago
                                FROM gos_nomina_pagos 
                                WHERE tipo_pago = 'SUELDO' 
                                AND gos_taller_id = '".$idtaller."'
                                AND fecha_pago  between '".$fecha_inicio."' and '".$fecha_fin."'
                                GROUP BY gos_usuario_id,fecha_pago) PA
                    ON U.gos_usuario_id = PA.gos_usuario_id

                    LEFT JOIN (SELECT gos_usuario_id,
                                sum(MontoPrestado) as prestamo,
                                sum(totalPagado) as pagado,
                                sum(saldo) as saldo
                                FROM gos_v_prestamos
                                WHERE gos_taller_id = '".$idtaller."'
                                GROUP BY gos_usuario_id) PRES
                    ON U.gos_usuario_id = PRES.gos_usuario_id

                    LEFT JOIN  (SELECT gos_usuario_asesor_id as gos_usuario_id,
                                sum(servicios) as servicios,
                                sum(comision) as comision,
                                sum(materiales) as materiales,
                                sum(desc_materiales) as desc_materiales,
                                sum(total) as total,
                                sum(Pago) as Pago
                                FROM gos_v_reporte_nomina_os
                                WHERE fechaCierreEtapa between '".$fecha_inicio."' and '".$fecha_fin."'
                                AND gos_taller_id = '".$idtaller."'
                                AND total > 0
                                GROUP BY gos_usuario_id
                                HAVING (sum(total)-sum(Pago))>0) OS 
                    ON U.gos_usuario_id = OS.gos_usuario_id
                    WHERE U.gos_taller_id = '".$idtaller."'
                    -- AND U.gos_usuario_id <> 1
                    GROUP BY U.gos_usuario_id
                    ORDER BY U.rol DESC, U.nombre ASC"
        ));

        $listadoOS = DB::select(DB::raw(
            "SELECT	O.gos_usuario_asesor_id,
                    O.gos_os_id,
                    C.nro_orden_interno,
                    C.nomb_aseguradora_min,
                    C.detallesVehiculo,
                    sum(O.servicios) as servicios,
                    sum(O.comision) as comision,
                    sum(O.materiales) AS materiales,
                    sum(O.desc_materiales) AS desc_materiales,
                    sum(O.total) AS total,
                    sum(O.Pago) AS pago
            FROM gos_v_reporte_nomina_os O 
            LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
            WHERE fechaCierreEtapa between '".$fecha_inicio."' and '".$fecha_fin."'
            AND O.gos_taller_id = '".$idtaller."'
            AND O.total > 0
            GROUP BY O.gos_usuario_asesor_id,O.gos_os_id,C.nro_orden_interno,C.nomb_aseguradora_min,C.detallesVehiculo
            HAVING (sum(O.total)-sum(O.Pago))>0"
        ));

        $fechaComision = $fechamin.' - '.$fechamax;
        $fechaPagoNomina = $fechamax;
        
        $listadoPerfiles = DB::select(DB::raw(
            "SELECT 'Administrativo' AS nomb_perfil
            UNION ALL
            SELECT nomb_perfil FROM gos_usuario_perfil WHERE gos_usuario_rol_id = 2
            "
        ));

        return view('/Reportes/ReporteNominaAgregar',compact('listadoNomina','listadoOS','fechaComision','fechaPagoNomina','listadoPerfiles'));
    }
    public function crearReporteFiltrado(Request $request){

        $perfiles = "'Administrativo','Laminero','Igualador','Preparador','Pintor','Mecánico','Aux mecánico','Eléctrico','Armador','Detallador','Pulidor','Lavador','TécnicPaint less','Vigilante','Limpieza','Mensajero','Mantenimiento','Supervisor','Pailerto','Carrocero','Gerente Taller',";

        if (isset($request->nomb_perfil)) {
            $perfiles = null;
            foreach ($request->nomb_perfil as $perfil) {
                $perfiles = $perfiles."'".$perfil."',";
            }    
        }

        $perfiles = trim($perfiles,',');       

        $idtaller=Session::get('taller_id');

        $fechaSplit = explode(" - ",$request->fecha_comision);
        $fecha_inicio = date("Y-m-d",strtotime($fechaSplit[0]));
        $fecha_fin = date("Y-m-d",strtotime($fechaSplit[1]));       
        $fechaPagoNomina = date("m/d/Y",strtotime($fechaSplit[1]));

        $listadoNomina = DB::select(
            DB::raw("SELECT U.gos_taller_id,U.gos_usuario_id,U.nombre,U.rol,U.nomb_rol,
                            (U.sueldo * ifnull(TS.semana,1)) as Sueldo, 
                            ifnull(PA.Pago,0) as SueldoPago,
                            (U.sueldo * ifnull(TS.semana,1)) - ifnull(PA.Pago,0) as SueldoPendiente,
                            ifnull(PRES.prestamo,0) as PrestamoTotal,
                            ifnull(PRES.pagado,0) as PrestamoPago,
                            ifnull(PRES.saldo,0) as PrestamoPendiente,
                            ifnull(OS.servicios,0) as Servicios,
                            ifnull(OS.comision,0) as Comision,
                            ifnull(OS.materiales,0) as materiales,
                            ifnull(OS.desc_materiales,0) as desc_materiales,
                            ifnull(OS.total,0) as Total,
                            ifnull(OS.Pago,0) as Pago
                    FROM gos_v_reporte_nomina_sueldos U 

                    LEFT JOIN (SELECT gos_usuario_id,
                                TIMESTAMPDIFF(day,  '".$fecha_inicio."', '".$fecha_fin."') as dias,
                                ROUND(TIMESTAMPDIFF(day,  '".$fecha_inicio."', '".$fecha_fin."') / 7,0) as semana
								FROM gos_v_reporte_nomina_sueldos
                                WHERE gos_taller_id = '".$idtaller."') TS 
					ON U.gos_usuario_id = TS.gos_usuario_id

                    LEFT JOIN (SELECT gos_usuario_id, fecha_pago,
                                SUM(monto_Total) as Pago
                                FROM gos_nomina_pagos 
                                WHERE tipo_pago = 'SUELDO' 
                                AND gos_taller_id = '".$idtaller."'
                                AND fecha_pago  between '".$fecha_inicio."' and '".$fecha_fin."'
                                GROUP BY gos_usuario_id,fecha_pago) PA
                    ON U.gos_usuario_id = PA.gos_usuario_id
                    
                    LEFT JOIN (SELECT gos_usuario_id,
                                sum(MontoPrestado) as prestamo,
                                sum(totalPagado) as pagado,
                                sum(saldo) as saldo
                                FROM gos_v_prestamos
                                WHERE gos_taller_id = '".$idtaller."'
                                GROUP BY gos_usuario_id) PRES
                    ON U.gos_usuario_id = PRES.gos_usuario_id
                    
                    LEFT JOIN  (SELECT gos_usuario_asesor_id as gos_usuario_id,
                                sum(servicios) as servicios,
                                sum(comision) as comision,
                                sum(materiales) as materiales,
                                sum(desc_materiales) as desc_materiales,
                                sum(total) as total,
                                sum(Pago) as Pago
                                FROM gos_v_reporte_nomina_os
                                WHERE fechaCierreEtapa between '".$fecha_inicio."' and '".$fecha_fin."'
                                AND gos_taller_id = '".$idtaller."'
                                AND total > 0
                                GROUP BY gos_usuario_id
                                HAVING (sum(total)-sum(Pago))>0) OS 
                    ON U.gos_usuario_id = OS.gos_usuario_id
                    WHERE U.gos_taller_id = '".$idtaller."'
                    AND U.rol IN (".$perfiles.")
                    GROUP BY U.gos_usuario_id
                    ORDER BY U.rol DESC, U.nombre ASC"
        ));

        $listadoOS = DB::select(DB::raw(
            "SELECT	O.gos_usuario_asesor_id,
                    O.gos_os_id,
                    C.nro_orden_interno,
                    C.nomb_aseguradora_min,
                    C.detallesVehiculo,
                    sum(O.servicios) as servicios,
                    sum(O.comision) as comision,
                    sum(O.materiales) AS materiales,
                    sum(O.desc_materiales) AS desc_materiales,
                    sum(O.total) AS total,
                    sum(O.Pago) AS pago
            FROM gos_v_reporte_nomina_os O 
            LEFT JOIN gos_v_os C on O.gos_os_id = C.gos_os_id
            WHERE fechaCierreEtapa between '".$fecha_inicio."' and '".$fecha_fin."'
            AND O.gos_taller_id = '".$idtaller."'
            AND O.total > 0
            GROUP BY O.gos_usuario_asesor_id,O.gos_os_id,C.nro_orden_interno,C.nomb_aseguradora_min,C.detallesVehiculo
            HAVING (sum(O.total)-sum(O.Pago))>0"
        ));
        
        $fechaComision = $request->fecha_comision;
        $perfilFiltros = $request->nomb_perfil;

        $listadoPerfiles = DB::select(DB::raw(
            "SELECT 'Administrativo' AS nomb_perfil
            UNION ALL
            SELECT nomb_perfil FROM gos_usuario_perfil WHERE gos_usuario_rol_id = 2
            "
        ));

        return view('/Reportes/ReporteNominaAgregar',compact('listadoNomina','listadoOS','fechaComision','fechaPagoNomina','listadoPerfiles','perfilFiltros'));
    }

    public function preparaDataTableervicio($nomtec){
        $idtaller=Session::get('taller_id');
        $ITemsOS = DB::select( DB::raw("SELECT CONCAT(fecha_inicio_et,'|',DATE_ADD(fecha_inicio_et, INTERVAL tiempo_meta_segundos SECOND),'|', fecha_promesa_os) as fecha_fin_etapa ,d.*, g.*
        FROM gos_v_os_etapas  d
        INNER JOIN gos_v_inicio_calendario g ON d.gos_os_id = g.gos_os_id
            WHERE tecnico = '".$nomtec."' AND d.gos_taller_id = ".$idtaller." AND gos_paq_servicio_id > 0" ));
            $ajax = $this->preparaDataTableAjax($ITemsOS, $this->getOpcionesEditDataTable());
            if (null != $ajax) {
                return $ajax;
            }
       }
    
    public function AgregarNomina(Request $request){
        $idtaller=Session::get('taller_id');
        $usuario=Session::get('usr_Data');
        $fecha_nomina = date("Y-m-d H:i:s", strtotime($request->fecha_nomina));
        $gos_nomina_id = 0;
        $carga = 0;

        foreach ($request->cargar as $value) {
            if($value == 'on'){
                $carga=$carga+1;
            }
        }
    
        if($carga == 0){
            return redirect('/ReporteNomina');
        }else{
            $nomina = new Gos_Nomina([
                'gos_taller_id' => $idtaller,
                'gos_usuario_id' => $usuario->gos_usuario_id,
                'fecha_nomina' => $fecha_nomina,
                'tipo_pago' => $request->tipo_pago,
                'observaciones' => $request->observaciones,
                'fecha_creacion' => date("Y-m-d H:i:s")
            ]);
            $nomina->save();
            $gos_nomina_id = $nomina->gos_nomina_id;

            $cantidad   = count($request->cargar);
            $cargas     = $request->cargar;
            $empleados  = $request->gos_usuario_id;
            $bancos     = $request->ban;
            $efectivos  = $request->efe;
            $totales    = $request->tot;
            $sueldos    = $request->sueldo;
            $presCobrar = $request->cobrar;
            $presDar    = $request->prestar;

            for($i=0; $i<$cantidad; $i++){
                if($cargas[$i] == 'on'){
                    
                    $total    = $totales[$i];
                    $empleado = $empleados[$i];
                    $banco    = $bancos[$i];
                    $efectivo = $efectivos[$i];
                    $sueldo   = $sueldos[$i];
                    $cobrarP  = $presCobrar[$i];
                    $prestarP = $presDar[$i];

                    if($sueldo-$total >= 0){
                        $tempTotal = $sueldo;
                        $tempEfec = $sueldo > $efectivo ? $efectivo : $sueldo;
                        $tempBanc = $sueldo > $banco ? $banco : $sueldo - $tempEfec;

                        $nomina_item = new Gos_Nomina_Pagos([
                            'gos_nomina_id' => $gos_nomina_id,
                            'gos_taller_id' => $idtaller,
                            'gos_usuario_id' => $empleado,
                            'fecha_pago' => $fecha_nomina,
                            'tipo_pago' => 'SUELDO',
                            'monto_Banco' => $tempBanc,
                            'monto_Efectivo' => $tempEfec,
                            'monto_Total' => $tempTotal
                        ]);
                        $nomina_item->save();
                        $total = $total-$tempTotal;
                        $efectivo = $efectivo-$tempEfec;
                        $banco = $banco-$tempBanc;
                    } 
                    
                    if($total > 0) {
                        $os = DB::select(
                            DB::raw("SELECT gos_usuario_asesor_id,gos_os_id,gos_os_item_id,total,Pago
                                FROM gos_v_reporte_nomina_os
                                WHERE gos_usuario_asesor_id = ".$empleado."
                                AND (total - Pago) > 0"
                            ));

                        for($i=0; $i<count($os); $i++){

                            $tempTotal = $os[$i]->total - $os[$i]->Pago;
                            $tempEfec = $tempTotal > $efectivo ? $efectivo : $tempTotal;
                            $tempBanc = $tempTotal > $banco ? $banco : $tempTotal - $tempEfec;

                            $nomina_item = new Gos_Nomina_Pagos([
                                'gos_nomina_id' => $gos_nomina_id,
                                'gos_taller_id' => $idtaller,
                                'gos_usuario_id' => $empleado,
                                'gos_os_id' => $os[$i]->gos_os_id,
                                'gos_os_item_id' => $os[$i]->gos_os_item_id,
                                'fecha_pago' => $fecha_nomina,
                                'tipo_pago' => 'OS',
                                'monto_Banco' => $tempBanc,
                                'monto_Efectivo' => $tempEfec,
                                'monto_Total' => $tempTotal
                            ]);

                            $nomina_item->save();
                            
                            $total = $total-$tempTotal;
                            $efectivo = $efectivo-$tempEfec;
                            $banco = $banco-$tempBanc;
                        }
                    }

                    //PRESTAMOS
                    $gos_prestamo_id = 0;
                    
                    if($prestarP > 0){
                        $prestamo = new Gos_Prestamo([
                            'gos_usuario_id' => $empleado,
                            'gos_taller_id' => $idtaller,
                            'observaciones' => '',
                            'fecha' => $fecha_nomina,
                            'total' => $prestarP
                        ]);
                        $prestamo->save();

                        $nomina_item = new Gos_Nomina_Pagos([
                            'gos_nomina_id' => $gos_nomina_id,
                            'gos_taller_id' => $idtaller,
                            'gos_usuario_id' => $empleado,
                            'gos_prestamo_id' => $prestamo->gos_prestamo_id,
                            'fecha_pago' => $fecha_nomina,
                            'tipo_pago' => 'PRESTAMO',
                            'Prestado' => $prestarP
                        ]);
                        $nomina_item->save();

                    }

                    if($cobrarP > 0){
                        $prest = DB::select( DB::raw("SELECT gos_usuario_id,gos_prestamo_id,saldo,FechaPrestamo
                                                        FROM gos_v_prestamos 
                                                        WHERE gos_usuario_id = ".$empleado));
                               
                        if(count($prest) == 1){
                            $pago = new Gos_Prestamo_Pagos([
                                'gos_prestamo_id' => $prest[0]->gos_prestamo_id,
                                'fechaPago' => $fecha_nomina,
                                'importe' => $cobrarP
                            ]);
                            $pago->save();

                            $nomina_item = new Gos_Nomina_Pagos([
                                'gos_nomina_id' => $gos_nomina_id,
                                'gos_taller_id' => $idtaller,
                                'gos_usuario_id' => $empleado,
                                'gos_prestamo_id' => $pago->gos_prestamo_id,
                                'fecha_pago' => $fecha_nomina,
                                'tipo_pago' => 'PRESTAMO',
                                'monto_Prestamo' => $cobrarP
                            ]);
                            $nomina_item->save();

                        } else {
                            foreach ($prest as $i => $prestamo) {
                                $cobro = $cobrarP;
                                if($cobro > 0){
                                    $cobro = $cobrarP > $prestamo->saldo ? $prestamo->saldo : $cobrarP;
                                    $pago = new Gos_Prestamo_Pagos([
                                        'gos_prestamo_id' => $prestamo->gos_prestamo_id,
                                        'fechaPago' => $fecha_nomina,
                                        'importe' => $cobro
                                    ]);
                                    $pago->save();
                                    $cobro = $cobro - $cobrarP;

                                    $nomina_item = new Gos_Nomina_Pagos([
                                        'gos_nomina_id' => $gos_nomina_id,
                                        'gos_taller_id' => $idtaller,
                                        'gos_usuario_id' => $empleado,
                                        'gos_prestamo_id' => $pago->gos_prestamo_id,
                                        'fecha_pago' => $fecha_nomina,
                                        'tipo_pago' => 'PRESTAMO',
                                        'monto_Prestamo' => $cobro
                                    ]);
                                    $nomina_item->save();
                                }
                            }
                        }
                    }
                }
            }
            return redirect('/ReporteNomina');
        }
    } 

    public function verNomina($gos_nomina_id){
        $idtaller=Session::get('taller_id');
        $ItemNomina = DB::select(
            DB::raw("SELECT P.gos_nomina_id,N.observaciones,N.tipo_pago, P.gos_usuario_id,P.gos_taller_id,
                    concat(U.nombre,' ',U.apellidos) as nombre,
                    max(fecha_pago) AS fecha_pago,
                    ifnull(PRES.prestado,0) as Prestado,
                    ifnull(PRES.Prestamo,0) as monto_Prestamo,
                    ifnull(SUE.Sueldo,0) as monto_Sueldo,
                    case when P.tipo_pago <> 'PRESTAMO' then sum(ifnull(monto_Banco,0)) end as monto_Banco,
                    case when P.tipo_pago <> 'PRESTAMO' then sum(ifnull(monto_Efectivo,0)) end as monto_Efectivo,
                    case when P.tipo_pago <> 'PRESTAMO' then sum(ifnull(monto_Total,0)) end as monto_Total
                FROM gos_nomina_pagos P
                    LEFT JOIN gos_nomina N on P.gos_nomina_id = N.gos_nomina_id
                    LEFT JOIN gos_usuario U ON P.gos_usuario_id = U.gos_usuario_id
                    LEFT JOIN (SELECT gos_usuario_id, gos_nomina_id, sum(ifnull(Prestado,0)) as prestado,sum(ifnull(monto_Prestamo,0)) as Prestamo
                                FROM gos_nomina_pagos
                                WHERE gos_prestamo_id is not null
                                GROUP BY gos_usuario_id, gos_nomina_id) PRES 
                        ON P.gos_usuario_id = PRES.gos_usuario_id AND P.gos_nomina_id = PRES.gos_nomina_id    
                    LEFT JOIN (SELECT gos_usuario_id, gos_nomina_id, sum(monto_Total) as Sueldo
                                FROM gos_nomina_pagos
                                WHERE tipo_pago = 'SUELDO'
                                GROUP BY gos_usuario_id, gos_nomina_id) SUE 
                        ON P.gos_usuario_id = SUE.gos_usuario_id AND P.gos_nomina_id = SUE.gos_nomina_id
                WHERE P.gos_nomina_id='".$gos_nomina_id."'
                GROUP BY P.gos_nomina_id,N.observaciones,N.tipo_pago, P.gos_usuario_id,P.gos_taller_id,
                concat(U.nombre,' ',U.apellidos)"
                ));
            $ajax = $this->preparaDataTableAjax($ItemNomina,'');
            return $ajax;
       }

}
