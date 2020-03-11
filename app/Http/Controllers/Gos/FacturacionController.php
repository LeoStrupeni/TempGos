<?php
namespace App\Http\Controllers\Gos;

//
use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Session;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Nota_Remision;
use App\Gos\Gos_Docventa;
use App\Gos\Gos_Docventa_Item;
use App\Gos\Gos_Docventa_Timbrado;
use App\Gos\Gos_Docventa_Codigo_Sat;
use App\Gos\Gos_Docventa_Cancelada;
use App\Gos\Gos_Docventa_Pago;
use App\Gos\Gos_Docventa_Pago_Relacionado;
use App\Gos\Gos_Nota_Remision_Item;
use App\Gos\Gos_Nota_Remision_Pago;
use Illuminate\Support\Facades\Storage;
use App\Gos\Gos_Taller;
use PDF;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_OS;
use App\Gos\Gos_Taller_Facturacion;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Metodo_Pago;

use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_Producto;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Cliente_Factura;
use App\Gos\Gos_Region_Estado;
use App\Gos\Gos_Region_Ciudad;
use App\Gos\Gos_Fac_Tipo_Persona;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Ase_Fac;
/**
 *
 * @author yois
 *
 */
class FacturacionController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $tipoventa ="";$estatus=""; $cuentaTodos=0; $cuentaFacturas=0; $cuentaNotaR=0; $cuentaCanceladas=0; $cuentaNcredido=0; $cuentaH=0; $VENTA=0; $MONTOPENDIENTE=0; $MONTOPAGADO=0;
      $idtaller=Session::get('taller_id');
      $listaMetodosPagos = Gos_Metodo_Pago::all();
      $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
      $tot = DB::select( DB::raw("SELECT *,gnr.gos_nota_remision_id as nota_id, totalPago FROM gos_nota_remision gnr
              LEFT JOIN gos_v_inicio_calendario goi ON gnr.gos_os_id = goi.gos_os_id
              LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
              LEFT JOIN (SELECT SUM(precio*if(cantidad =0, 1,cantidad)) precio, gos_nota_remision_id
      						FROM gos_nota_remision_item GROUP BY gos_nota_remision_id) as f ON f.gos_nota_remision_id = gnr.gos_nota_remision_id
      		    LEFT JOIN (SELECT SUM(monto) totalPago, gos_nota_remision_id FROM gos_nota_remision_pago GROUP BY gos_nota_remision_id) as g ON g.gos_nota_remision_id = gnr.gos_nota_remision_id
              WHERE  gos_taller_id = ".$idtaller."  GROUP BY gnr.gos_nota_remision_id ORDER BY gnr.gos_nota_remision_id ASC"));
      $factura = DB::select(DB::raw("SELECT folio, gd.metodo_pago, nro_orden_interno,estatus, gos_docventa_id, goi.gos_os_id,goi.nomb_cliente,gd.fecha, detallesVehiculo, nomb_aseguradora_min, gd.total
              FROM gos_docventa gd
              LEFT JOIN gos_v_inicio_calendario goi ON gd.gos_os_id = goi.gos_os_id
              WHERE  gd.gos_taller_id =  $idtaller   GROUP BY gos_docventa_id ORDER BY gos_docventa_id "));
      $rep = DB::select(DB::raw("SELECT * FROM gos_docventa WHERE gos_taller_id = $idtaller AND tipo_de_comprobante = 'P'GROUP BY gos_docventa_id ORDER BY gos_docventa_id"));

      foreach ($factura as $fac) {
       if ($fac->estatus=="CANCELADA" ){$cuentaCanceladas=$cuentaCanceladas+1;}
       $VENTA=$VENTA+$fac->total;
      }
      foreach ($tot as $remision) {
      if ($remision->estatus=="CANCELADA" && $remision->fecha_historico_rem==null) {$cuentaCanceladas=$cuentaCanceladas+1;}
      if ($remision->fecha_historico_rem==null) {$cuentaNotaR=$cuentaNotaR+1;}
      if($remision->fecha_historico_rem>1){$cuentaH=$cuentaH+1;}
      $VENTA=$VENTA+$remision->precio;
      $MONTOPAGADO=$MONTOPAGADO+$remision->totalPago+$remision->abono;
      }
      foreach ($rep as $nc) {
        $MONTOPAGADO=$MONTOPAGADO+$nc->total;
      }
      $MONTOPENDIENTE=$VENTA-$MONTOPAGADO;
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id',$idtaller)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
         //________CONTADORES CARPETAS________________
         $cuentaFacturas=count($factura);
         $cuentaNotaR;
         $cuentaNcredido=0;
         $cuentaTodos=$cuentaFacturas+$cuentaNotaR+$cuentaNcredido;
        return view('Facturacion/emision', compact('tot','factura','taller_conf_vehiculo','taller_conf_ase','listaAseguradoras','tipoventa','estatus','listaMetodosPagos','rep','cuentaTodos','cuentaFacturas','cuentaNotaR','cuentaCanceladas','cuentaNcredido','cuentaH','VENTA','MONTOPENDIENTE','MONTOPAGADO'));
    }

    public function store(Request $request)
    {   $start=""; $end="";
        if(isset($request->rangoFechas)){
          $f = explode(" - ",$request->rangoFechas);
          $start = date('Y-m-d',strtotime(date('Y-m-d', strtotime($f[0]))));
          $end = date('Y-m-d',strtotime(date('Y-m-d', strtotime($f[1]))));
          }
       //____________DATE FORMAT END_______________________________________________________________
       $tipoventa ="";$estatus=""; $cuentaTodos=0; $cuentaFacturas=0; $cuentaNotaR=0; $cuentaCanceladas=0; $cuentaNcredido=0; $cuentaH=0; $VENTA=0; $MONTOPENDIENTE=0; $MONTOPAGADO=0;
         $idtaller=Session::get('taller_id');
         $listaMetodosPagos = Gos_Metodo_Pago::all();
         $listaAseguradoras=Gos_Aseguradora::where('gos_taller_id',$idtaller)->get();
         //____________________________________________________DATES FILTER
         $tot = DB::select( DB::raw("SELECT *,gnr.gos_nota_remision_id as nota_id, totalPago FROM gos_nota_remision gnr
                 LEFT JOIN gos_v_inicio_calendario goi ON gnr.gos_os_id = goi.gos_os_id
                 LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
                 LEFT JOIN (SELECT SUM(precio*if(cantidad =0, 1,cantidad)) precio, gos_nota_remision_id
         						FROM gos_nota_remision_item GROUP BY gos_nota_remision_id) as f ON f.gos_nota_remision_id = gnr.gos_nota_remision_id
         		    LEFT JOIN (SELECT SUM(monto) totalPago, gos_nota_remision_id FROM gos_nota_remision_pago GROUP BY gos_nota_remision_id) as g ON g.gos_nota_remision_id = gnr.gos_nota_remision_id
                 WHERE  gos_taller_id = ".$idtaller." and fecha_creacion_os > ' ".$start."' and  fecha_creacion_os < '".$end."'  GROUP BY gnr.gos_nota_remision_id ORDER BY gnr.gos_nota_remision_id ASC"));

         $factura = DB::select(DB::raw("SELECT folio, gd.metodo_pago, nro_orden_interno,estatus, gos_docventa_id, goi.gos_os_id,goi.nomb_cliente,gd.fecha, detallesVehiculo, nomb_aseguradora_min, gd.total
                 FROM gos_docventa gd
                 LEFT JOIN gos_v_inicio_calendario goi ON gd.gos_os_id = goi.gos_os_id
                 WHERE fecha_facturado IS NOT NULL AND gd.gos_taller_id =  $idtaller and gd.fecha > '".$start."' and gd.fecha <'".$end."'GROUP BY gos_docventa_id ORDER BY gos_docventa_id "));

         $rep = DB::select(DB::raw("SELECT * FROM gos_docventa WHERE gos_taller_id = $idtaller AND tipo_de_comprobante = 'P'  and fecha > '$start' and fecha < '$end'  GROUP BY gos_docventa_id ORDER BY gos_docventa_id"));
           //____________________________________________________________ASEGURADORA FILTER__________________________________________________________________________________________________________________________________
          if ($request->gos_aseguradora_id!=null) {
            $ase=$request->gos_aseguradora_id;
            $tot = DB::select( DB::raw("SELECT *,gnr.gos_nota_remision_id as nota_id, totalPago FROM gos_nota_remision gnr
                    LEFT JOIN gos_v_inicio_calendario goi ON gnr.gos_os_id = goi.gos_os_id
                    LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
                    LEFT JOIN (SELECT SUM(precio*if(cantidad =0, 1,cantidad)) precio, gos_nota_remision_id
            				FROM gos_nota_remision_item GROUP BY gos_nota_remision_id) as f ON f.gos_nota_remision_id = gnr.gos_nota_remision_id
            		    LEFT JOIN (SELECT SUM(monto) totalPago, gos_nota_remision_id FROM gos_nota_remision_pago GROUP BY gos_nota_remision_id) as g ON g.gos_nota_remision_id = gnr.gos_nota_remision_id
                    WHERE  gos_taller_id = ".$idtaller." and fecha_creacion_os > ' ".$start."' and  fecha_creacion_os < '".$end."' and goi.gos_aseguradora_id=$ase GROUP BY gnr.gos_nota_remision_id ORDER BY gnr.gos_nota_remision_id ASC"));

            $factura = DB::select(DB::raw("SELECT folio, gd.metodo_pago, nro_orden_interno,estatus, gos_docventa_id, goi.gos_os_id,goi.nomb_cliente,gd.fecha, detallesVehiculo, nomb_aseguradora_min, gd.total
                    FROM gos_docventa gd LEFT JOIN gos_v_inicio_calendario goi ON gd.gos_os_id = goi.gos_os_id
                    WHERE fecha_facturado IS NOT NULL AND gd.gos_taller_id =  $idtaller and gd.fecha > '".$start."' and gd.fecha <'".$end."'  and goi.gos_aseguradora_id=$ase GROUP BY gos_docventa_id ORDER BY gos_docventa_id "));

            $rep = DB::select(DB::raw("SELECT * FROM gos_docventa WHERE gos_taller_id = $idtaller AND tipo_de_comprobante = 'P'  and fecha > '$start' and fecha < '$end'  GROUP BY gos_docventa_id ORDER BY gos_docventa_id"));
          }
          //________________________________________________________ESTATUS DOCUMENTO______________________________________________________________________________________________________________________________________
           if($request->estatus!=null){
             $esta=$request->estatus;
             $tot = DB::select( DB::raw("SELECT *,gnr.gos_nota_remision_id as nota_id, totalPago FROM gos_nota_remision gnr
                     LEFT JOIN gos_v_inicio_calendario goi ON gnr.gos_os_id = goi.gos_os_id
                     LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
                     LEFT JOIN (SELECT SUM(precio*if(cantidad =0, 1,cantidad)) precio, gos_nota_remision_id
                    FROM gos_nota_remision_item GROUP BY gos_nota_remision_id) as f ON f.gos_nota_remision_id = gnr.gos_nota_remision_id
                    LEFT JOIN (SELECT SUM(monto) totalPago, gos_nota_remision_id FROM gos_nota_remision_pago GROUP BY gos_nota_remision_id) as g ON g.gos_nota_remision_id = gnr.gos_nota_remision_id
                     WHERE  gos_taller_id = ".$idtaller." and fecha_creacion_os > ' ".$start."' and  fecha_creacion_os < '".$end."' and gnr.estatus='$esta' GROUP BY gnr.gos_nota_remision_id ORDER BY gnr.gos_nota_remision_id ASC"));

             $factura = DB::select(DB::raw("SELECT folio, gd.metodo_pago, nro_orden_interno,estatus, gos_docventa_id, goi.gos_os_id,goi.nomb_cliente,gd.fecha, detallesVehiculo, nomb_aseguradora_min, gd.total
                     FROM gos_docventa gd LEFT JOIN gos_v_inicio_calendario goi ON gd.gos_os_id = goi.gos_os_id
                     WHERE fecha_facturado IS NOT NULL AND gd.gos_taller_id =  $idtaller and gd.fecha > '".$start."' and gd.fecha <'".$end."'  and gd.estatus='$esta' GROUP BY gos_docventa_id ORDER BY gos_docventa_id "));

             $rep = DB::select(DB::raw("SELECT * FROM gos_docventa WHERE gos_taller_id = $idtaller AND tipo_de_comprobante = 'P'  and fecha > '$start' and fecha < '$end'  and  estatus='$esta' GROUP BY gos_docventa_id ORDER BY gos_docventa_id"));
           }
          //________________________________________________________Estatus y ASeguradora FILTER_________________________________________________________________________________________________________________________
          if($request->estatus!=null && $request->gos_aseguradora_id!=null){   $ase=$request->gos_aseguradora_id;    $esta=$request->estatus;
            $tot = DB::select( DB::raw("SELECT *,gnr.gos_nota_remision_id as nota_id, totalPago FROM gos_nota_remision gnr
                    LEFT JOIN gos_v_inicio_calendario goi ON gnr.gos_os_id = goi.gos_os_id
                    LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
                    LEFT JOIN (SELECT SUM(precio*if(cantidad =0, 1,cantidad)) precio, gos_nota_remision_id
                   FROM gos_nota_remision_item GROUP BY gos_nota_remision_id) as f ON f.gos_nota_remision_id = gnr.gos_nota_remision_id
                   LEFT JOIN (SELECT SUM(monto) totalPago, gos_nota_remision_id FROM gos_nota_remision_pago GROUP BY gos_nota_remision_id) as g ON g.gos_nota_remision_id = gnr.gos_nota_remision_id
                    WHERE  gos_taller_id = ".$idtaller." and fecha_creacion_os > ' ".$start."' and  fecha_creacion_os < '".$end."' and gnr.estatus='$esta' and goi.gos_aseguradora_id=$ase GROUP BY gnr.gos_nota_remision_id ORDER BY gnr.gos_nota_remision_id ASC"));

            $factura = DB::select(DB::raw("SELECT folio, gd.metodo_pago, nro_orden_interno,estatus, gos_docventa_id, goi.gos_os_id,goi.nomb_cliente,gd.fecha, detallesVehiculo, nomb_aseguradora_min, gd.total
                    FROM gos_docventa gd LEFT JOIN gos_v_inicio_calendario goi ON gd.gos_os_id = goi.gos_os_id
                    WHERE fecha_facturado IS NOT NULL AND gd.gos_taller_id =  $idtaller and gd.fecha > '".$start."' and gd.fecha <'".$end."' and goi.gos_aseguradora_id=$ase  and gd.estatus='$esta' GROUP BY gos_docventa_id ORDER BY gos_docventa_id "));

            $rep = DB::select(DB::raw("SELECT * FROM gos_docventa WHERE gos_taller_id = $idtaller AND tipo_de_comprobante = 'P'  and fecha > '$start' and fecha < '$end'  and  estatus='$esta' GROUP BY gos_docventa_id ORDER BY gos_docventa_id"));

          }
         //_________________________________________________________TIPOVENTA FILTER_______________________________________________________________________________________________________________________________________
          if ($request->tipo_venta=="F") {$tot=array();}
          if ($request->tipo_venta=="NR") {$factura=array(); $rep=array();}



         foreach ($factura as $fac) {
          if ($fac->estatus=="CANCELADA" ){$cuentaCanceladas=$cuentaCanceladas+1;}
          $VENTA=$VENTA+$fac->total;
         }
         foreach ($tot as $remision) {
         if ($remision->estatus=="CANCELADA" && $remision->fecha_historico_rem==null) {$cuentaCanceladas=$cuentaCanceladas+1;}
         if ($remision->fecha_historico_rem==null) {$cuentaNotaR=$cuentaNotaR+1;}
         if($remision->fecha_historico_rem>1){$cuentaH=$cuentaH+1;}
         $VENTA=$VENTA+$remision->precio;
         $MONTOPAGADO=$MONTOPAGADO+$remision->totalPago+$remision->abono;
         }
         foreach ($rep as $nc) {
           $MONTOPAGADO=$MONTOPAGADO+$nc->total;
         }
         $MONTOPENDIENTE=$VENTA-$MONTOPAGADO;
           $usuario=Session::get('usr_Data');
           $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id',$idtaller)->first();
           $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            //________CONTADORES CARPETAS________________
            $cuentaFacturas=count($factura);
            $cuentaNotaR;
            $cuentaNcredido=0;
            $cuentaTodos=$cuentaFacturas+$cuentaNotaR+$cuentaNcredido;
           return view('Facturacion/emision', compact('tot','factura','taller_conf_vehiculo','taller_conf_ase','listaAseguradoras','tipoventa','estatus','listaMetodosPagos','rep','cuentaTodos','cuentaFacturas','cuentaNotaR','cuentaCanceladas','cuentaNcredido','cuentaH','VENTA','MONTOPENDIENTE','MONTOPAGADO'));

    }

    public function SendHistorico($id){
      $hoy = date("Y-m-d");
      $remision=Gos_Nota_Remision::find($id);
      $remision->fecha_historico_rem=$hoy;
      $remision->save();
      return back();
    }
    public function regresarHistorico($id){
      $hoy = date("Y-m-d");
      $remision=Gos_Nota_Remision::find($id);
      $remision->fecha_historico_rem=null;
      $remision->save();
      return back();
    }

    public function fechaHistorico($id)
    {
        $notaRemision = Gos_Nota_Remision::find($id);
        $gos_os_id = $notaRemision->gos_os_id;
        $gos = Gos_OS::find($gos_os_id);
        $now = new \DateTime();
        $now->format('Y-m-d H:i:s');
        if(isset($notaRemision->estatus)){
            if ($gos->fecha_historico == null && $notaRemision->estatus == "PAGADO") {
              $gos->fecha_historico = $now;
              $gos->save();
              return 1;
            }
            else{
              return 2;
          }
      }
      else{
        if ($gos->fecha_historico == null && $notaRemision->nomb_forma_pago == "Contado") {
          $gos->fecha_historico = $now;
          $gos->save();
          return 1;
        }
        else{
          return 2;
      }
      }
    }
    public function pagos()
    {
        return view('Facturacion/pagos');
    }
    public function nuevafactura($id){
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        $codigoSat = Gos_Docventa_Codigo_Sat::all();
        $idtaller=Session::get('taller_id');
        $osProducto = DB::select(DB::raw("SELECT *
        FROM gos_v_os_items
        WHERE gos_os_id = $id AND nombre IS NOT NULL
        ORDER BY orden_etapa"));
         $os = DB::select( DB::raw("
                SELECT
                IFNULL(CONCAT(c.nombre,
                                ' ',
                                c.apellidos
                            ),
                        ' ') AS nomb_cliente,
                                tipod.tipo_danio,
                                riesg.nomb_riesgo,
                                tipoo.tipo_orden,
                                este.estado_expediente,
                a.empresa,
                    IFNULL(CONCAT(
                                    IFNULL(mar.marca_vehiculo, ''),
                                    ', ',
                                    IFNULL(modl.modelo_vehiculo, ''),
                                    ', ',
                                    IFNULL(v.anio_vehiculo, ''),
                                    ' Placa: ',
                                    IFNULL(v.placa, ''),
                                    ' Económico: ',
                                    IFNULL(v.economico, ''),
                                    ' Serie: ',
                                    IFNULL(v.nro_serie, '')),
                            ' ') AS detallesVehiculo,
                    os.gos_os_id AS gos_os_id,
                    os.gos_cliente_id AS gos_cliente_id,
                    os.gos_taller_id AS gos_taller_id,
                    os.gos_vehiculo_id AS gos_vehiculo_id,
                    os.descuento_tipo AS descuento_tipo,
                    os.gos_aseguradora_id,
                    os.iva AS iva,
                    os.nro_orden,
                    os.ing_grua,
                    os.con_especiales,
                    gtcg.iva AS iva_taller,
                    os.gos_ot_id AS gos_ot_id,
                    os.gos_os_riesgo_id AS gos_os_riesgo_id,
                    os.gos_os_tipo_danio_id AS gos_os_tipo_danio_id,
                    os.gos_os_tipo_o_id AS gos_os_tipo_o_id,
                    v.nro_serie AS nro_serie,
                    os.nro_siniestro AS nro_siniestro,
                    os.nro_reporte AS nro_reporte,
                    os.demerito AS demerito,
                    os.deducible AS deducible,
                    os.nro_orden_interno AS nro_orden_interno,
                    os.nro_poliza AS nro_poliza,
                    os.fecha_promesa_os AS fecha_promesa_os,
                    os.fecha_ingreso_v_os AS fecha_ingreso_v_os,
                    os.fecha_creacion_os AS fecha_creacion_os,
                    os.fecha_terminado AS fecha_terminado,
                    os.fecha_entregado AS fecha_entregado,
                    os.fecha_facturado AS fecha_facturado,
                    os.fecha_pago AS fecha_pago,
                    a.gos_aseguradora_id AS gos_aseguradora_id,
                    os.gos_os_estado_exp_id AS gos_os_estado_exp_id
                FROM
                    gos_os os
                    LEFT JOIN gos_cliente c ON os.gos_cliente_id = c.gos_cliente_id
                    LEFT JOIN gos_vehiculo v ON os.gos_vehiculo_id = v.gos_vehiculo_id
                    LEFT JOIN gos_color col ON v.color_vehiculo = col.codigohex
                    LEFT JOIN gos_vehiculo_modelo modl ON v.gos_vehiculo_modelo_id = modl.gos_vehiculo_modelo_id
                    LEFT JOIN gos_vehiculo_marca mar ON modl.gos_vehiculo_marca_id = mar.gos_vehiculo_marca_id
                    LEFT JOIN gos_aseguradora a ON os.gos_aseguradora_id = a.gos_aseguradora_id
                    LEFT JOIN gos_os_tipo_o tipoo ON os.gos_os_tipo_o_id = tipoo.gos_os_tipo_o_id
                    LEFT JOIN gos_os_tipo_danio tipod ON os.gos_os_tipo_danio_id = tipod.gos_os_tipo_danio_id
                    LEFT JOIN gos_os_riesgo riesg ON os.gos_os_riesgo_id = riesg.gos_os_riesgo_id
                    LEFT JOIN gos_os_estado_exp este ON os.gos_os_estado_exp_id = este.gos_os_estado_exp_id
                    LEFT JOIN gos_taller_conf_gen gtcg ON gtcg.gos_taller_id = os.gos_taller_id
                    LEFT JOIN gos_usuario gu ON gu.gos_usuario_id = os.gos_usuario_id
                    LEFT JOIN gos_v_os_etapa_activa_fin gvoeaf ON gvoeaf.gos_os_id = os.gos_os_id
                    WHERE os.gos_os_id =  $id"
                ));


        return view('Facturacion/nuevaFacturaOS',  compact('os','osProducto','listaMetodosPagos','codigoSat'));
    }
    public function nuevaNotaRemision($id){
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        $idtaller=Session::get('taller_id');
        $osProducto = DB::select(DB::raw("SELECT *
        FROM (
        SELECT *,IF(gos_producto_id > 0, descripcion, nombre) nombreNota
        FROM gos_v_os_items
        WHERE gos_os_id = $id
        ORDER BY orden_etapa) AS G"));
         $os = DB::select( DB::raw("
                SELECT
                IFNULL(CONCAT(c.nombre,
                                ' ',
                                c.apellidos
                            ),
                        ' ') AS nomb_cliente,
                                tipod.tipo_danio,
                                riesg.nomb_riesgo,
                                tipoo.tipo_orden,
                                este.estado_expediente,
                a.empresa,
                    IFNULL(CONCAT(
                                    IFNULL(mar.marca_vehiculo, ''),
                                    ', ',
                                    IFNULL(modl.modelo_vehiculo, ''),
                                    ', ',
                                    IFNULL(v.anio_vehiculo, ''),
                                    ' Placa: ',
                                    IFNULL(v.placa, ''),
                                    ' Económico: ',
                                    IFNULL(v.economico, ''),
                                    ' Serie: ',
                                    IFNULL(v.nro_serie, '')),
                            ' ') AS detallesVehiculo,
                    os.gos_os_id AS gos_os_id,
                    os.gos_cliente_id AS gos_cliente_id,
                    os.gos_taller_id AS gos_taller_id,
                    os.gos_vehiculo_id AS gos_vehiculo_id,
                    os.descuento_tipo AS descuento_tipo,
                    os.iva AS iva,
                    os.nro_orden,
                    os.ing_grua,
                    os.con_especiales,
                    gtcg.iva AS iva_taller,
                    os.gos_ot_id AS gos_ot_id,
                    os.gos_os_riesgo_id AS gos_os_riesgo_id,
                    os.gos_os_tipo_danio_id AS gos_os_tipo_danio_id,
                    os.gos_os_tipo_o_id AS gos_os_tipo_o_id,
                    v.nro_serie AS nro_serie,
                    os.nro_siniestro AS nro_siniestro,
                    os.nro_reporte AS nro_reporte,
                    os.demerito AS demerito,
                    os.deducible AS deducible,
                    os.nro_orden_interno AS nro_orden_interno,
                    os.nro_poliza AS nro_poliza,
                    os.fecha_promesa_os AS fecha_promesa_os,
                    os.fecha_ingreso_v_os AS fecha_ingreso_v_os,
                    os.fecha_creacion_os AS fecha_creacion_os,
                    os.fecha_terminado AS fecha_terminado,
                    os.fecha_entregado AS fecha_entregado,
                    os.fecha_facturado AS fecha_facturado,
                    os.fecha_pago AS fecha_pago,
                    a.gos_aseguradora_id AS gos_aseguradora_id,
                    os.gos_os_estado_exp_id AS gos_os_estado_exp_id
                FROM
                    gos_os os
                    LEFT JOIN gos_cliente c ON os.gos_cliente_id = c.gos_cliente_id
                    LEFT JOIN gos_vehiculo v ON os.gos_vehiculo_id = v.gos_vehiculo_id
                    LEFT JOIN gos_color col ON v.color_vehiculo = col.codigohex
                    LEFT JOIN gos_vehiculo_modelo modl ON v.gos_vehiculo_modelo_id = modl.gos_vehiculo_modelo_id
                    LEFT JOIN gos_vehiculo_marca mar ON modl.gos_vehiculo_marca_id = mar.gos_vehiculo_marca_id
                    LEFT JOIN gos_aseguradora a ON os.gos_aseguradora_id = a.gos_aseguradora_id
                    LEFT JOIN gos_os_tipo_o tipoo ON os.gos_os_tipo_o_id = tipoo.gos_os_tipo_o_id
                    LEFT JOIN gos_os_tipo_danio tipod ON os.gos_os_tipo_danio_id = tipod.gos_os_tipo_danio_id
                    LEFT JOIN gos_os_riesgo riesg ON os.gos_os_riesgo_id = riesg.gos_os_riesgo_id
                    LEFT JOIN gos_os_estado_exp este ON os.gos_os_estado_exp_id = este.gos_os_estado_exp_id
                    LEFT JOIN gos_taller_conf_gen gtcg ON gtcg.gos_taller_id = os.gos_taller_id
                    LEFT JOIN gos_usuario gu ON gu.gos_usuario_id = os.gos_usuario_id
                    LEFT JOIN gos_v_os_etapa_activa_fin gvoeaf ON gvoeaf.gos_os_id = os.gos_os_id
                    WHERE os.gos_os_id =  $id"
                ));


         return view('Facturacion/nuevaRemisionOS', compact('os','osProducto','listaMetodosPagos'));
    }
    public function agregarNotaRemision(Request $request){

        $gos_os_id = $request->gos_os_id;
        $con = $request->con;
        $efe = $request->efe;
        $ban = $request->ban;
        $des = $request->des;
        $tipo = $request->tipoitem;
        $nota = new Gos_Nota_Remision();
        $nota->gos_forma_pago_id = $request->gos_forma_pago_id;
        if($request->gos_forma_pago_id == 1){
          $nota->estatus = "PAGADO";
        }
        else{
          $nota->estatus = "PENDIENTE";
        }
        $nota->fecha_nota = $request->fecha_nota;
        $nota->gos_metodo_pago_id = $request->gos_metodo_pago_id;
        $nota->fecha_abono = $request->fecha_abono;
        $nota->abono = $request->abono;
        $nota->desglose = $request->desglose;
        $nota->gos_os_id = $gos_os_id;
        $nota->save();
        $gos_nota_remision_id = $nota->gos_nota_remision_id;
        for($i=0;$i <count($con); $i++){
            $descuento = isset($des[$i]) ? $des[$i] : 0;
            $notaItem = new Gos_Nota_Remision_Item();
            $notaItem->concepto = $con[$i];
            $notaItem->precio = $efe[$i];
            $notaItem->cantidad = $ban[$i];
            $notaItem->descuento =  $descuento;
            if($tipo[$i]=="Etapa"){
                $notaItem->tipo = 0;
            }
            if($tipo[$i]=="Producto"){
                $notaItem->tipo = 1;
            }
            $notaItem->gos_nota_remision_id =  $gos_nota_remision_id;
            $notaItem->save();
        }
        $gos_os = Gos_OS::find($request->gos_os_id);
        $gos_os->fecha_facturado = date("Y-m-d H:i:s");
        $gos_os->save();
        return redirect('/gestion-facturas');
    }
    public function eliminarNotaRemision($id){
        $notaRemision = Gos_Nota_Remision::find($id);
        $notaRemision->delete();
        return 1;
    }
    public function editarNotaRemision($id){
        $listaMetodosPagos = Gos_Metodo_Pago::all();
        $idtaller=Session::get('taller_id');
        $nota = DB::select(DB::raw("SELECT *
            FROM gos_nota_remision gnr
            LEFT JOIN gos_nota_remision_item  gnri ON gnr.gos_nota_remision_id = gnri.gos_nota_remision_id
            LEFT JOIN gos_forma_pago gfp ON gfp.gos_forma_pago_id = gnr.gos_forma_pago_id
            LEFT JOIN gos_metodo_pago gtp ON gtp.gos_metodo_pago_id = gnr.gos_metodo_pago_id
            WHERE gnr.gos_nota_remision_id = $id"));


            $os = DB::select( DB::raw("
                    SELECT
                    IFNULL(CONCAT(c.nombre,
                                    ' ',
                                    c.apellidos
                                ),
                            ' ') AS nomb_cliente,
                                    tipod.tipo_danio,
                                    riesg.nomb_riesgo,
                                    tipoo.tipo_orden,
                                    este.estado_expediente,
                    a.empresa,
                        IFNULL(CONCAT(
                                        IFNULL(mar.marca_vehiculo, ''),
                                        ', ',
                                        IFNULL(modl.modelo_vehiculo, ''),
                                        ', ',
                                        IFNULL(v.anio_vehiculo, ''),
                                        ' Placa: ',
                                        IFNULL(v.placa, ''),
                                        ' Económico: ',
                                        IFNULL(v.economico, ''),
                                        ' Serie: ',
                                        IFNULL(v.nro_serie, '')),
                                ' ') AS detallesVehiculo,
                        os.gos_os_id AS gos_os_id,
                        os.gos_cliente_id AS gos_cliente_id,
                        os.gos_taller_id AS gos_taller_id,
                        os.gos_vehiculo_id AS gos_vehiculo_id,
                        os.descuento_tipo AS descuento_tipo,
                        os.iva AS iva,
                        os.nro_orden,
                        os.ing_grua,
                        os.con_especiales,
                        gtcg.iva AS iva_taller,
                        os.gos_ot_id AS gos_ot_id,
                        os.gos_os_riesgo_id AS gos_os_riesgo_id,
                        os.gos_os_tipo_danio_id AS gos_os_tipo_danio_id,
                        os.gos_os_tipo_o_id AS gos_os_tipo_o_id,
                        v.nro_serie AS nro_serie,
                        os.nro_siniestro AS nro_siniestro,
                        os.nro_reporte AS nro_reporte,
                        os.demerito AS demerito,
                        os.deducible AS deducible,
                        os.nro_orden_interno AS nro_orden_interno,
                        os.nro_poliza AS nro_poliza,
                        os.fecha_promesa_os AS fecha_promesa_os,
                        os.fecha_ingreso_v_os AS fecha_ingreso_v_os,
                        os.fecha_creacion_os AS fecha_creacion_os,
                        os.fecha_terminado AS fecha_terminado,
                        os.fecha_entregado AS fecha_entregado,
                        os.fecha_facturado AS fecha_facturado,
                        os.fecha_pago AS fecha_pago,
                        a.gos_aseguradora_id AS gos_aseguradora_id,
                        os.gos_os_estado_exp_id AS gos_os_estado_exp_id
                    FROM
                        gos_os os
                        LEFT JOIN gos_cliente c ON os.gos_cliente_id = c.gos_cliente_id
                        LEFT JOIN gos_vehiculo v ON os.gos_vehiculo_id = v.gos_vehiculo_id
                        LEFT JOIN gos_color col ON v.color_vehiculo = col.codigohex
                        LEFT JOIN gos_vehiculo_modelo modl ON v.gos_vehiculo_modelo_id = modl.gos_vehiculo_modelo_id
                        LEFT JOIN gos_vehiculo_marca mar ON modl.gos_vehiculo_marca_id = mar.gos_vehiculo_marca_id
                        LEFT JOIN gos_aseguradora a ON os.gos_aseguradora_id = a.gos_aseguradora_id
                        LEFT JOIN gos_os_tipo_o tipoo ON os.gos_os_tipo_o_id = tipoo.gos_os_tipo_o_id
                        LEFT JOIN gos_os_tipo_danio tipod ON os.gos_os_tipo_danio_id = tipod.gos_os_tipo_danio_id
                        LEFT JOIN gos_os_riesgo riesg ON os.gos_os_riesgo_id = riesg.gos_os_riesgo_id
                        LEFT JOIN gos_os_estado_exp este ON os.gos_os_estado_exp_id = este.gos_os_estado_exp_id
                        LEFT JOIN gos_taller_conf_gen gtcg ON gtcg.gos_taller_id = os.gos_taller_id
                        LEFT JOIN gos_usuario gu ON gu.gos_usuario_id = os.gos_usuario_id
                        LEFT JOIN gos_v_os_etapa_activa_fin gvoeaf ON gvoeaf.gos_os_id = os.gos_os_id
                        WHERE os.gos_os_id =  ".$nota[0]->gos_os_id
                ));


         return view('Facturacion/editarNota', compact('os','nota','listaMetodosPagos'));
        return $id;
    }
    public function agregarNuevaFactura(Request $request){
        $idtaller = Session::get('taller_id');
        $tot = DB::select( DB::raw("SELECT *
        FROM gos_docventa WHERE gos_taller_id = $idtaller ORDER BY gos_docventa_id DESC LIMIT 1"));
        $aseguradora = DB::select( DB::raw("SELECT*
        FROM gos_os go
        LEFT JOIN gos_aseguradora gc ON go.gos_aseguradora_id = gc.gos_aseguradora_id
        LEFT JOIN gos_ase_fac gcf ON gc.gos_aseguradora_id = gcf.relacion_id
        WHERE gos_os_id =  $request->gos_os_id"));
        $cliente = DB::select( DB::raw("SELECT*
        FROM gos_os go
        LEFT JOIN gos_cliente gc ON go.gos_cliente_id = gc.gos_cliente_id
        LEFT JOIN gos_cliente_factura gcf ON gc.gos_cliente_id = gcf.relacion_id
        WHERE gos_os_id = $request->gos_os_id"));
        $nro = isset($tot[0]->nro) ? $tot[0]->nro: 0;
        $folio = isset($tot[0]->folio) ? $tot[0]->folio: 0;
        $efe = $request->efe;
        $ban = $request->ban;
        $con = $request->con;
        $des = $request->des;
        $sat = $request->sat;
        $uni = $request->uni;
        $subtotal = 0;
        for($e=0; $e < count($efe); $e++){
          if($efe[$e]>0){
            if($sat[$e] != NULL){
              $subtotal += $efe[$e]*$ban[$e];
            }
          }
        }
        $doc_venta = new Gos_Docventa();
        $doc_venta->gos_taller_id = $idtaller;
        $doc_venta->gos_os_id = $request->gos_os_id;
        $doc_venta->gos_aseguradora_id = $request->gos_aseguradora_id;
        $doc_venta->gos_vehiculo_id = $request->gos_vehiculo_id;
        if($aseguradora[0]->habilita_facturacion_cliente == 0){
          $doc_venta->rfc = strtoupper($aseguradora[0]->rfc);
          $doc_venta->razon_social = $aseguradora[0]->razon_social;
        }else{
          $doc_venta->rfc = strtoupper($cliente[0]->rfc);
          $doc_venta->razon_social = $cliente[0]->razon_social;
        }
        $doc_venta->tipo = "FAC";
        $doc_venta->nro = $nro + 1;
        $doc_venta->estatus = "PENDIENTE";
        $doc_venta->total_impuesto = strval(number_format($subtotal*0.16,2,".",""));
        $doc_venta->tasa = "00000000000016.00";
        $doc_venta->metodo_pago = $request->metodo_pago;
        $doc_venta->tipo_de_comprobante = "I";
        $doc_venta->subtotal = strval(number_format($subtotal,2,".",""));
        $doc_venta->total = strval(number_format($subtotal+($subtotal*0.16),2,".",""));
        $doc_venta->fecha = $request->fecha_nota;
        $doc_venta->serie = "A";
        $doc_venta->folio = $folio + 1;
        $doc_venta->uso_cfdi = $request->uso_cfdi;
        $doc_venta->forma_pago = $request->gos_metodo_pago_id;
        $doc_venta->save();
        $doc_venta_id = $doc_venta->gos_docventa_id;
        for($i=0;$i<count($con);$i++){
            $doc_venta_item = new Gos_Docventa_Item();
            $doc_venta_item->gos_docventa_id = $doc_venta_id;
            $doc_venta_item->cantidad = $ban[$i];
            $doc_venta_item->nro_identificacion = 1;
            $doc_venta_item->valor_unitario = strval($efe[$i]);
            $doc_venta_item->importe = strval($efe[$i]*$ban[$i]);
            $doc_venta_item->descuento = ($des[$i] != null) ? $des[$i]: 0;
            $doc_venta_item->clave_prod_serv =  $sat[$i];
            $doc_venta_item->producto_medida = 1;
            $doc_venta_item->descripcion = $con[$i];
            if($efe[$i]>0){
                if($sat[$i] != NULL){
                    $doc_venta_item->importe_impuesto = strval(($efe[$i]*$ban[$i])*0.16);
                    $doc_venta_item->clave_unidad_medida = $uni[$i];
                    $doc_venta_item->save();
                }
            }
        }
        $timbrado = $this->timbradoLogica($doc_venta_id,"I");
        if(!is_array($timbrado)){
            $doc_venta_delete = Gos_Docventa::find($doc_venta_id);
            $doc_venta_delete->delete();
            return back()->with('alert', $timbrado);
        }
        else{
            $doc_timbrado = new Gos_Docventa_Timbrado();
            $doc_timbrado->gos_docventa_id = $doc_venta_id;
            $doc_timbrado->status = $timbrado[0];
            $doc_timbrado->mensaje = $timbrado[1];
            $doc_timbrado->noCert = $timbrado[2];
            $doc_timbrado->sello = $timbrado[3];
            $doc_timbrado->CFDI = $timbrado[4];
            $doc_timbrado->cadena = $timbrado[5];
            $doc_timbrado->certSAT = $timbrado[6];
            $doc_timbrado->certCFDI = $timbrado[7];
            $doc_timbrado->UUID = $timbrado[8];
            $doc_timbrado->selloSAT = $timbrado[9];
            $doc_timbrado->fecha = $timbrado[10];
            $doc_timbrado->total = $timbrado[11];
            $doc_timbrado->totalLetra = $timbrado[12];
            $doc_timbrado->qr = $timbrado[13];
            $doc_timbrado->save();

            $gos_os = Gos_OS::find($request->gos_os_id);
            $gos_os->fecha_facturado = date("Y-m-d H:i:s");
            $gos_os->save();

            $gosVenta = Gos_Docventa::find($doc_venta_id);
            $gosVenta->uuid = $timbrado[8];
            $gosVenta->save();
            return redirect('/gestion-facturas');
        }
    }
    public function ImpNotaRemision($id){
        // return PDF::loadView('Facturacion.pdf')->inline('NotaRemision');
        $listataller = Gos_Taller::find(Session::get('taller_id'));
        $notaRemision = Gos_Nota_Remision::find($id);
        $notaRemisionItem = Gos_Nota_Remision_Item::where('gos_nota_remision_id',$id)->get();
        $css = public_path().'\gos\css\bootstrap.min.css';
        $css1 = public_path().'/assets/plugins/general/socicon/css/socicon.css';
        $css2 = public_path().'/assets/plugins/general/plugins/line-awesome/css/line-awesome.css';
        $css3 = public_path().'/assets/plugins/general/plugins/flaticon/flaticon.css';
        $css4 = public_path().'/assets/plugins/general/plugins/flaticon2/flaticon.css';
        $css5 = public_path().'/assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css';
        $logo =public_path().Storage::url($listataller->taller_lototipo);
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
         $os = DB::select( DB::raw("
            SELECT
            IFNULL(CONCAT(c.nombre,
                            ' ',
                            c.apellidos
                        ),
                    ' ') AS nomb_cliente,
                            tipod.tipo_danio,
                            riesg.nomb_riesgo,
                            tipoo.tipo_orden,
                            este.estado_expediente,
            a.empresa,
                IFNULL(CONCAT(
                                IFNULL(mar.marca_vehiculo, ''),
                                ', ',
                                IFNULL(modl.modelo_vehiculo, ''),
                                ', ',
                                IFNULL(v.anio_vehiculo, ''),
                                ' Placa: ',
                                IFNULL(v.placa, ''),
                                ' Económico: ',
                                IFNULL(v.economico, ''),
                                ' Serie: ',
                                IFNULL(v.nro_serie, '')),
                        ' ') AS detallesVehiculo,
                        v.placa,
                os.gos_os_id AS gos_os_id,
                os.gos_cliente_id AS gos_cliente_id,
                os.gos_taller_id AS gos_taller_id,
                os.gos_vehiculo_id AS gos_vehiculo_id,
                os.descuento_tipo AS descuento_tipo,
                os.iva AS iva,
                os.nro_orden,
                os.ing_grua,
                os.con_especiales,
                gtcg.iva AS iva_taller,
                os.gos_ot_id AS gos_ot_id,
                os.gos_os_riesgo_id AS gos_os_riesgo_id,
                os.gos_os_tipo_danio_id AS gos_os_tipo_danio_id,
                os.gos_os_tipo_o_id AS gos_os_tipo_o_id,
                v.nro_serie AS nro_serie,
                os.nro_siniestro AS nro_siniestro,
                os.nro_reporte AS nro_reporte,
                os.demerito AS demerito,
                os.deducible AS deducible,
                os.nro_orden_interno AS nro_orden_interno,
                os.nro_poliza AS nro_poliza,
                os.fecha_promesa_os AS fecha_promesa_os,
                os.fecha_ingreso_v_os AS fecha_ingreso_v_os,
                os.fecha_creacion_os AS fecha_creacion_os,
                os.fecha_terminado AS fecha_terminado,
                os.fecha_entregado AS fecha_entregado,
                os.fecha_facturado AS fecha_facturado,
                os.fecha_pago AS fecha_pago,
                a.gos_aseguradora_id AS gos_aseguradora_id,
                os.gos_os_estado_exp_id AS gos_os_estado_exp_id
            FROM
                gos_os os
                LEFT JOIN gos_cliente c ON os.gos_cliente_id = c.gos_cliente_id
                LEFT JOIN gos_vehiculo v ON os.gos_vehiculo_id = v.gos_vehiculo_id
                LEFT JOIN gos_color col ON v.color_vehiculo = col.codigohex
                LEFT JOIN gos_vehiculo_modelo modl ON v.gos_vehiculo_modelo_id = modl.gos_vehiculo_modelo_id
                LEFT JOIN gos_vehiculo_marca mar ON modl.gos_vehiculo_marca_id = mar.gos_vehiculo_marca_id
                LEFT JOIN gos_aseguradora a ON os.gos_aseguradora_id = a.gos_aseguradora_id
                LEFT JOIN gos_os_tipo_o tipoo ON os.gos_os_tipo_o_id = tipoo.gos_os_tipo_o_id
                LEFT JOIN gos_os_tipo_danio tipod ON os.gos_os_tipo_danio_id = tipod.gos_os_tipo_danio_id
                LEFT JOIN gos_os_riesgo riesg ON os.gos_os_riesgo_id = riesg.gos_os_riesgo_id
                LEFT JOIN gos_os_estado_exp este ON os.gos_os_estado_exp_id = este.gos_os_estado_exp_id
                LEFT JOIN gos_taller_conf_gen gtcg ON gtcg.gos_taller_id = os.gos_taller_id
                LEFT JOIN gos_usuario gu ON gu.gos_usuario_id = os.gos_usuario_id
                LEFT JOIN gos_v_os_etapa_activa_fin gvoeaf ON gvoeaf.gos_os_id = os.gos_os_id
                WHERE os.gos_os_id =  $notaRemision->gos_os_id"
        ));
        $gos_os_id=$os[0]->gos_os_id;
        $oss = Gos_V_Os_Generada::find($gos_os_id);
        $numorden = Gos_Os::where('gos_os_id',$gos_os_id)->first('nro_orden_interno');
        $compact = compact('notaRemision','notaRemisionItem','os','css','css1','css2','css3','css4','css5','logo','oss','numorden','taller_conf_ase','taller_conf_vehiculo');
        // return view('Facturacion.pdf',$compact);
        return PDF::loadView('Facturacion.pdf',$compact)->inline('Nota-Remisión-'.time().'.pdf');
    }
    public function ImpXML($id){
        $idtaller=Session::get('taller_id');
        $listataller = Gos_Taller::find(Session::get('taller_id'));
        $factura = Gos_Docventa::find($id);
        $facturaitem = Gos_Docventa_Item::where('gos_docventa_id',$id)->get();
        $facturatimbrado = Gos_Docventa_Timbrado::where('gos_docventa_id',$id)->get();
        header('Content-type: text/xml');
        header('Pragma: public');
        header('Cache-control: private');
        header('Expires: -1');
        header('Content-Disposition: attachment; filename=Factura-'.time().'-'.$id.'.xml');
        header('Content-Type: application/octet-stream');
        echo base64_decode($facturatimbrado[0]->CFDI);
    }
    public function ImpXMLCancelado($id){
      $facturatimbrado = Gos_Docventa_Cancelada::where('gos_docventa_id',$id)->get();
      header('Content-type: text/xml');
      header('Pragma: public');
      header('Cache-control: private');
      header('Expires: -1');
      header('Content-Disposition: attachment; filename=Factura-'.time().'-'.$id.'.xml');
      header('Content-Type: application/octet-stream');
      echo base64_decode($facturatimbrado[0]->xml);
    }
    public function ImpFactura($id){
        $idtaller=Session::get('taller_id');
        $listataller = Gos_Taller::find(Session::get('taller_id'));
        $factura = Gos_Docventa::find($id);
        $facturaitem = Gos_Docventa_Item::where('gos_docventa_id',$id)->get();
        $facturatimbrado = Gos_Docventa_Timbrado::where('gos_docventa_id',$id)->get();
        $notaRemisionItem = Gos_Nota_Remision_Item::where('gos_nota_remision_id',$id)->get();
        $css = public_path().'\gos\css\bootstrap.min.css';
        $css1 = public_path().'/assets/plugins/general/socicon/css/socicon.css';
        $css2 = public_path().'/assets/plugins/general/plugins/line-awesome/css/line-awesome.css';
        $css3 = public_path().'/assets/plugins/general/plugins/flaticon/flaticon.css';
        $css4 = public_path().'/assets/plugins/general/plugins/flaticon2/flaticon.css';
        $css5 = public_path().'/assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css';

        $logo =public_path().Storage::url($listataller->taller_lototipo);
        $logoproorder = public_path().'\img\logo.png ';

        $gos_os_id=$factura->gos_os_id;
        $oss = Gos_V_Os_Generada::find($gos_os_id);
        $tallerfac = DB::select( DB::raw("SELECT *  FROM  gos_taller_facturacion gtf
        left JOIN gos_region_ciudad grc ON gtf.dir_fiscal_region_ciudad_id = grc.gos_region_ciudad_id
        left JOIN gos_region_estado gre ON grc.gos_region_estado_id = gre.gos_region_estado_id
        WHERE gos_taller_id = $idtaller"
        ));
        $idcliente = $oss->gos_cliente_id;
        $clientefac = DB::select( DB::raw("SELECT *  FROM  gos_cliente gc
        left JOIN gos_cliente_factura gcf ON gc.gos_cliente_id = gcf.relacion_id
        left JOIN gos_region_ciudad grc ON gcf.gos_fac_region_ciudad_id = grc.gos_region_ciudad_id
        left JOIN gos_region_estado gre ON grc.gos_region_estado_id = gre.gos_region_estado_id
        WHERE gos_cliente_id = $idcliente"
        ));
        $gos_aseguradora_id=$factura->gos_aseguradora_id;
        $asegfac = DB::select( DB::raw("SELECT *  FROM  gos_aseguradora ga
        left JOIN gos_ase_fac gaf ON ga.gos_aseguradora_id = gaf.relacion_id
        left JOIN gos_region_ciudad grc ON gaf.ase_fac_gos_region_ciudad_id = grc.gos_region_ciudad_id
        left JOIN gos_region_estado gre ON grc.gos_region_estado_id = gre.gos_region_estado_id
        WHERE gos_aseguradora_id =  $gos_aseguradora_id"
        ));
        $numorden = Gos_Os::where('gos_os_id',$gos_os_id)->first('nro_orden_interno');
        $tallerfac = $tallerfac[0];
        $clientefac = $clientefac[0];
        $asegfac = $asegfac[0];
        // return($oss);
        $qr = base64_decode($facturatimbrado[0]->qr);
        file_put_contents('storage/qr.jpg', $qr);
        $qrGenerado =public_path().Storage::url('qr.jpg');

        $codigo = $facturatimbrado[0]->noCert;
        $compact = compact('factura','facturaitem','qrGenerado','facturatimbrado','css','css1','css2','css3','css4','css5','logo','oss','logoproorder','numorden','tallerfac','listataller','clientefac','asegfac');

        // return view('Facturacion.facpdf',$compact);
        return PDF::loadView('Facturacion.facpdf',$compact)->inline('Factura-'.time().'-'.$id.'.pdf');
    }
    function timbradoLogica($gos_docventa_id, $tipo_comprobante){
        $idtaller=Session::get('taller_id');
        $fac = file_get_contents('http://ws.proordersistem.com.mx/Facturacion/consumeSelladoTimbradoDisXII.php?gos_docventa_id='.$gos_docventa_id.'&tipo_de_comprobante='.$tipo_comprobante.'&gos_taller_id='.$idtaller);
        if(strpos($fac, "ERROR")){
            $timbrado = $fac;
        }
        else{
            $statusExploded = explode("Ini:0:",$fac);
            $status = explode("Fin::Fin",$statusExploded[1]);
            $messageExploded = explode("Ini:1:",$fac);
            $message = explode("Fin::Fin",$messageExploded[1]);
            $noCertExploded = explode("Ini:2:",$fac);
            $noCert = explode("Fin::Fin",$noCertExploded[1]);
            $selloExploded = explode("Ini:3:",$fac);
            $sello = explode("Fin::Fin",$selloExploded[1]);
            $CFDIExploded = explode("Ini:4:",$fac);
            $CFDI = explode("Fin::Fin",$CFDIExploded[1]);
            $cadenaExploded = explode("Ini:5:",$fac);
            $cadena = explode("Fin::Fin",$cadenaExploded[1]);
            $certSATExploded = explode("Ini:6:",$fac);
            $certSAT = explode("Fin::Fin",$certSATExploded[1]);
            $certCFDIExploded = explode("Ini:7:",$fac);
            $certCFDI = explode("Fin::Fin",$certCFDIExploded[1]);
            $UUIDExploded = explode("Ini:8:",$fac);
            $UUID = explode("Fin::Fin",$UUIDExploded[1]);
            $selloSATExploded = explode("Ini:9:",$fac);
            $selloSAT = explode("Fin::Fin",$selloSATExploded[1]);
            $fechaExploded = explode("Ini:10:",$fac);
            $fecha = explode("Fin::Fin",$fechaExploded[1]);
            $totExploded = explode("Ini:11:",$fac);
            $tot = explode("Fin::Fin",$totExploded[1]);
            $totLExploded = explode("Ini:12:",$fac);
            $totL = explode("Fin::Fin",$totLExploded[1]);
            $qrExploded = explode("Ini:13:",$fac);
            $qr = explode("Fin::Fin",$qrExploded[1]);
            $timbrado = array($status[0], $message[0], $noCert[0], $sello[0], $CFDI[0], $cadena[0], $certSAT[0], $certCFDI[0], $UUID[0], $selloSAT[0], $fecha[0], $tot[0], $totL[0], $qr[0]);
        }

        return $timbrado;
    }
    public function editarcliente($idcli,$id){
        // $listarcliente = Gos_Cliente::find($idcli);
        // $listarcliente = Gos_Cliente::find($idcli);



        $idtaller=Session::get('taller_id');
        $clientefac = DB::select( DB::raw("SELECT *  FROM  gos_cliente gc
        LEFT JOIN gos_cliente_factura gcf ON gc.gos_cliente_id = gcf.relacion_id
        LEFT JOIN (SELECT gos_region_ciudad_id as ciudad_id, gos_region_estado_id as estado_id, nomb_ciudad  FROM gos_region_ciudad  ) as grc ON  grc.ciudad_id = gcf.gos_fac_region_ciudad_id
        LEFT JOIN gos_region_estado gre ON grc.estado_id = gre.gos_region_estado_id
        WHERE gos_cliente_id = $idcli AND gos_taller_id = $idtaller"
        ));

        $clientefac = $clientefac[0];
        $listaEstados = Gos_Region_Estado::all();
        $listaCiudades = Gos_Region_Ciudad::all();
        $listaTipoPersonas = Gos_Fac_Tipo_Persona::all();
        $personaact = Gos_Fac_Tipo_Persona::find($clientefac->gos_fac_tipo_persona_id);


        if($clientefac->gos_region_ciudad_id != 0)
        {
          $ciudadact = Gos_Region_Ciudad::find($clientefac->gos_region_ciudad_id);
          $estadoact = Gos_Region_Estado::find($ciudadact->gos_region_estado_id);
          $compact = compact('id','idcli','clientefac','listaEstados','listaCiudades','ciudadact','estadoact','listaTipoPersonas','personaact');
        }
        else{
          $compact = compact('id','idcli','clientefac','listaEstados','listaCiudades','listaTipoPersonas','personaact');
        }




        // return($compact);
        return view('Facturacion/EditarCliente',$compact)->with("notification","Cliente actualizado");
    }
    public function guardarCliente($idcli,$id,Request $request)
    {

      //  return $request->gos_region_ciudad;

      $validatedData = $request->validate([


          'gos_fac_tipo_persona_id'  => 'required|max:255',
          'razon_social'  => 'required|max:255',
          'rfc'  => 'required|max:255',
          'email_factura'  => 'required|max:255',
          'calle_nro_fac'  => 'required|max:255',
          'nro_exterior_fac'  => 'required|max:255',
          'cp_fac'  => 'required|max:255',
          'gos_fac_region_ciudad_id'  => 'required|max:255',
          'cliente_fac_municipio'  => 'required|max:255',
          'cliente_fac_localidad'  => 'required|max:255',




        ],
      $messages = [


      'gos_fac_tipo_persona_id.required' => 'Inserte el tipo de persona',
      'razon_social.required' => 'Inserte la razon social',
      'rfc.required' => 'Inserte el rfc',
      'email_factura.required' => 'Inserte el email',
      'calle_nro_fac.required' => 'Inserte la calle',
      'nro_exterior_fac.required' => 'Inserte el numero extereior',
      'cp_fac.required' => 'Inserte el cp',
      'gos_fac_region_ciudad_id.required' => 'Inserte la region ciudad',
      'cliente_fac_municipio.required' => 'Inserte el municipio',
      'cliente_fac_localidad.required' => 'Inserte la localidad',


       ]);


       DB::update("update gos_cliente set gos_region_ciudad_id=?,
                                          nombre=?,
                                          apellidos=?,
                                          empresa=?,
                                          celular=?,
                                          telefono_fijo=?,
                                          calle_nro=?,
                                          codigo_postal=?,
                                          cliente_municipio=?,
                                          gos_region_ciudad_id=?,
                                          cliente_localidad=? where gos_cliente_id=".$idcli

                                            ,[
                                          $request->gos_region_ciudad,
                                          $request->nombre,
                                          $request->apellidos,
                                          $request->empresa,
                                          $request->celular,
                                          $request->telefono_fijo,
                                          $request->calle_nro,
                                          $request->codigo_postal,
                                          $request->cliente_municipio,
                                          $request->gos_region_ciudad_id,
                                          $request->cliente_localidad
                                            ]);

      $clientedatosfac= Gos_Cliente_Factura::find($idcli);

      if($clientedatosfac !=null){


        DB::update("update gos_cliente_factura set gos_fac_tipo_persona_id=?,
                                                  razon_social=?,
                                                  rfc=?,
                                                  email_factura=?,
                                                  calle_nro_fac=?,
                                                  nro_exterior_fac=?,
                                                  nro_interior_fac=?,
                                                  cp_fac=?,

                                                  gos_fac_region_ciudad_id=?,
                                                  cliente_fac_municipio=?,
                                                  cliente_fac_localidad=?,
                                                  indicaciones=? where relacion_id=".$idcli

                                                  ,[
                                                    $request->gos_fac_tipo_persona_id,
                                                    $request->razon_social,
                                                    $request->rfc,
                                                    $request->email_factura,
                                                    $request->calle_nro_fac,
                                                    $request->nro_exterior_fac,
                                                    $request->nro_interior_fac,
                                                    $request->cp_fac,
                                                //falta gos_fac_region_estado_id
                                                    $request->gos_fac_region_ciudad_id,
                                                    $request->cliente_fac_municipio,
                                                    $request->cliente_fac_localidad,
                                                    $request->indicaciones
                                                  ]);
          }

          if($clientedatosfac==null){


            $DclieFac = new Gos_Cliente_Factura();

            $DclieFac->relacion_id = $idcli;
            $DclieFac->gos_fac_tipo_persona_id = $request->gos_fac_tipo_persona_id;
            $DclieFac->razon_social = $request->razon_social;
            $DclieFac->rfc = $request->rfc;
            $DclieFac->email_factura = $request->email_factura;
            $DclieFac->indicaciones = $request->indicaciones;
            $DclieFac->calle_nro_fac = $request->calle_nro_fac;
            $DclieFac->nro_exterior_fac = $request->nro_exterior_fac;
            $DclieFac->nro_interior_fac = $request->nro_interior_fac;
            $DclieFac->cp_fac = $request->cp_fac;
            $DclieFac->gos_fac_region_ciudad_id = $request->gos_fac_region_ciudad_id;
            $DclieFac->cliente_fac_localidad = $request->cliente_fac_localidad;
            $DclieFac->cliente_fac_municipio = $request->cliente_fac_municipio;


            $DclieFac->save();

        }
       $idtaller=Session::get('taller_id');
       $clientefac = DB::select( DB::raw("SELECT *  FROM  gos_cliente gc
       LEFT JOIN gos_cliente_factura gcf ON gc.gos_cliente_id = gcf.relacion_id
       LEFT JOIN (SELECT gos_region_ciudad_id as ciudad_id, gos_region_estado_id as estado_id, nomb_ciudad  FROM gos_region_ciudad  ) as grc ON  grc.ciudad_id = gcf.gos_fac_region_ciudad_id
       LEFT JOIN gos_region_estado gre ON grc.estado_id = gre.gos_region_estado_id
       WHERE gos_cliente_id = $idcli AND gos_taller_id = $idtaller"
       ));

       $clientefac = $clientefac[0];
       $listaEstados = Gos_Region_Estado::all();
       $listaCiudades = Gos_Region_Ciudad::all();
       $listaTipoPersonas = Gos_Fac_Tipo_Persona::all();
       $personaact = Gos_Fac_Tipo_Persona::find($clientefac->gos_fac_tipo_persona_id);

       if($clientefac->gos_region_ciudad_id != 0)
       {
         $ciudadact = Gos_Region_Ciudad::find($clientefac->gos_region_ciudad_id);
         $estadoact = Gos_Region_Estado::find($ciudadact->gos_region_estado_id);
         $compact = compact('id','idcli','clientefac','listaEstados','listaCiudades','ciudadact','estadoact','listaTipoPersonas','personaact');
       }
       else{
        $compact = compact('id','idcli','clientefac','listaEstados','listaCiudades','listaTipoPersonas','personaact');
       }
        // dd($clientefac->gos_fac_tipo_persona_id);


      return redirect("/ordenes-serv/Entregadas")->with("notification","Cliente actualizado");//view('Facturacion/EditarCliente',$compact)->with("notification","Cliente actualizado");
    }
    public function editaraseguradora($idaseg,$id){
      // $listarcliente = Gos_Cliente::find($idcli);
      // $listarcliente = Gos_Cliente::find($idcli);



      $idtaller=Session::get('taller_id');
      $asegfac = DB::select( DB::raw("SELECT *  FROM  gos_aseguradora ga
      LEFT JOIN gos_ase_fac gaf ON ga.gos_aseguradora_id = gaf.relacion_id
      LEFT JOIN (SELECT gos_region_ciudad_id as ciudad_id, gos_region_estado_id as estado_id, nomb_ciudad  FROM gos_region_ciudad  ) as grc ON  grc.ciudad_id = gaf.ase_fac_gos_region_ciudad_id
      LEFT JOIN gos_region_estado gre ON grc.estado_id = gre.gos_region_estado_id
      WHERE gos_aseguradora_id = $idaseg AND gos_taller_id = $idtaller"
      ));

      $asegfac = $asegfac[0];
      $listaEstados = Gos_Region_Estado::all();
      $listaCiudades = Gos_Region_Ciudad::all();
      $listaTipoPersonas = Gos_Fac_Tipo_Persona::all();
      $personaact = Gos_Fac_Tipo_Persona::find($asegfac->gos_fac_tipo_persona_id);


      if($asegfac->ase_fac_gos_region_ciudad_id != 0)
      {
        $ciudadact = Gos_Region_Ciudad::find($asegfac->ase_fac_gos_region_ciudad_id);
        $estadoact = Gos_Region_Estado::find($ciudadact->gos_region_estado_id);
        $compact = compact('id','idaseg','asegfac','listaEstados','listaCiudades','ciudadact','estadoact','listaTipoPersonas','personaact');
      }
      else{
        $compact = compact('id','idaseg','asegfac','listaEstados','listaCiudades','listaTipoPersonas','personaact');
      }




      // return($compact);
      return view('Facturacion/EditarAseguradora',$compact)->with("notification","Aseguradora actualizada");
    }
    public function guardaraseguradora($idaseg,$id,Request $request)
    {
      $ase=Gos_Aseguradora::find($idaseg);
      $ase->empresa=$request->empresa;
      $ase->contacto=$request->contacto;
      $ase->telefono_fijo=$request->telefono_fijo;
      $ase->celular=$request->celular;
      $ase->email_enlace=$request->email_enlace;
      $ase->save();
      $asefac=Gos_Ase_Fac::where('relacion_id',$idaseg)->first();
      if($asefac==null){$asefac= new Gos_Ase_Fac();}
      $asefac->gos_fac_tipo_persona_id=$request->gos_fac_tipo_persona_id;
      $asefac->razon_social=$request->razon_social;
      $asefac->rfc=$request->rfc;
      $asefac->email_factura=$request->email_factura;
      $asefac->nro_exterior_fac=$request->nro_exterior_fac;
      $asefac->nro_interior_fac=$request->nro_interior_fac;
      $asefac->calle_nro_fac=$request->calle_nro_fac;
      $asefac->cp_fac=$request->cp_fac;
      $asefac->indicaciones=$request->indicaciones;
      $asefac->ase_fac_gos_region_ciudad_id=$request->ase_fac_gos_region_ciudad_id;
      $asefac->ase_fac_localidad=$request->ase_fac_localidad;
      $asefac->ase_fac_municipio=$request->ase_fac_municipio;
      $asefac->save();
      return back();
    }
    public function cancelarNotaRemision($nota_id){
      $gos_nota = Gos_Nota_Remision::find($nota_id);
      $gos_nota->estatus="CANCELADA";
      $gos_nota->save();
      $gos_os = Gos_OS::find($gos_nota->gos_os_id);
      $gos_os->fecha_facturado = null;
      $gos_os->save();
      return back();
    }
    public function pagarNotaRemision(Request $request){
      $gos_nota_remision = new Gos_Nota_Remision_Pago();
      $gos_nota_remision->gos_nota_remision_id = $request->nota_id;
      $gos_nota_remision->gos_metodo_pago_id = $request->gos_metodo_pago_id;
      $gos_nota_remision->monto = $request->monto_abono;
      $gos_nota_remision->fecha_abono = date("Y-m-d",strtotime($request->fecha_abono));
      $gos_nota_remision->observaciones = $request->observacionesAnticipo;
      $gos_nota_remision->timestamp = date("Y-m-d H:i:s");
      $gos_nota_remision->save();
      return back();
    }
    public function cancelarFactura($id){
      $cancelacion = Gos_Docventa::find($id);
      $idtaller=Session::get('taller_id');
      $fac = file_get_contents('http://ws.proordersistem.com.mx/Facturacion/cancelaDocumentoDisXII.php?gos_docventa_id='.$cancelacion->gos_docventa_id.'&gos_taller_id='.$idtaller);
      if(strpos($fac, "ERROR")){
        $timbrado = $fac;
      }
      else{
          $docventa = Gos_Docventa::find($id);
          $gos_os_id = $docventa->gos_os_id;
          $docventa->estatus = "CANCELADA";
          $docventa->save();
          $statusExploded = explode("Ini:0:",$fac);
          $status = explode("Fin::Fin",$statusExploded[1]);
          $messageExploded = explode("Ini:1:",$fac);
          $message = explode("Fin::Fin",$messageExploded[1]);
          $noCertExploded = explode("Ini:2:",$fac);
          $noCert = explode("Fin::Fin",$noCertExploded[1]);
          $cancelada = new Gos_Docventa_Cancelada();
          $cancelada->gos_docventa_id =$id;
          $cancelada->mensaje = $message[0];
          $cancelada->xml =  $noCert[0];
          $cancelada->save();
          $gos_os = Gos_OS::find($gos_os_id);
          $gos_os->fecha_facturado = null;
          $gos_os->save();
        }
        return redirect('/gestion-facturas');
    }
    public function pagosMultiples(Request $request){
      $idtaller=Session::get('taller_id');
      $equals = 0;
      if(isset($request->ordenes)){
        foreach($request->ordenes as $o){
          $gosOrdenes = Gos_Docventa::find($o);
          $array[] = $gosOrdenes->rfc;
          $uuid[] = $gosOrdenes->uuid;
          $total[] = $gosOrdenes->total;
          $razon = $gosOrdenes->razon_social;
        }
        for($i = 0; $i < count($array); $i++){
          $j = $i+1;
          if($j < count($array)){
            if($array[$i] != $array[$j]){
              $equals =1;
            }
            else{
              $equals =0;
            }
          }
        }
        if($equals == 0){
          $subtotal = $request->cantidad - $request->cantidad*0.16;
          $iva = $request->cantidad*0.16;
          $tot = DB::select( DB::raw("SELECT *
          FROM gos_docventa
          WHERE gos_taller_id = $idtaller
          ORDER BY gos_docventa_id DESC
          LIMIT 1"));
          $docventa = new Gos_Docventa();
          $docventa->gos_taller_id = $idtaller;
          $docventa->rfc = $array[0];
          $docventa->razon_social = $razon;
          $docventa->tipo = "ND";
          $docventa->nro = $tot[0]->nro+1;
          $docventa->estatus = "PAGADO";
          $docventa->total_impuesto = strval(number_format($iva,2,".",""));
          $docventa->tasa = "00000000000016.00";
          $docventa->metodo_pago = "PPD";
          $docventa->tipo_de_comprobante = "P";
          $docventa->subtotal =strval(number_format($subtotal,2,".",""));
          $docventa->total = strval(number_format($request->cantidad,2,".",""));
          $docventa->fecha = $request->fecha;
          $docventa->serie = "A";
          $docventa->folio = $tot[0]->folio+1;
          $docventa->uso_cfdi = "G03";
          $docventa->forma_pago = $request->gos_metodo_pago_id;
          $docventa->save();

          $id = $docventa->gos_docventa_id;
          $pagado = new Gos_Docventa_Pago();
          $pagado->gos_docventa_id = $id;
          $pagado->fecha_pago = $request->fecha;
          $pagado->forma_de_pago_p = $request->gos_metodo_pago_id;
          $pagado->monto = strval(number_format($request->cantidad,2,".",""));
          $pagado->save();
          $montoFacturar =0;
          foreach($total as $t){
            $montoFacturar +=$t;
          }
          if($montoFacturar > $request->cantidad){
            return back()->with('alert', "El monto a pagar es menor que el monto total de las facturas.");
          }
          foreach($uuid as $u){
            $idpagado = $pagado->gos_docventapago_id;
            $relacionado = new Gos_Docventa_Pago_Relacionado();
            $relacionado->gos_docventapago_id = $idpagado;
            $relacionado->id_documento = $u;
            $relacionado->num_parcialidad = 1;
            $relacionado->saldo_anterior = strval(number_format($request->cantidad,2,".",""));
            $relacionado->importe_pagado = strval(number_format($request->cantidad,2,".",""));
            $relacionado->saldo_insoluto = 0;
            $relacionado->save();

          }
          $fac = file_get_contents('http://ws.proordersistem.com.mx/Facturacion/consumeSelladoTimbradoDisXII.php?gos_docventa_id='.$id.'&tipo_de_comprobante=P&gos_taller_id='.$idtaller);
          if(strpos($fac, "ERROR")){
              $timbrado = $fac;
              return back()->with('alert', $timbrado);
          }
          else{
              $statusExploded = explode("Ini:0:",$fac);
              $status = explode("Fin::Fin",$statusExploded[1]);
              $messageExploded = explode("Ini:1:",$fac);
              $message = explode("Fin::Fin",$messageExploded[1]);
              $noCertExploded = explode("Ini:2:",$fac);
              $noCert = explode("Fin::Fin",$noCertExploded[1]);
              $selloExploded = explode("Ini:3:",$fac);
              $sello = explode("Fin::Fin",$selloExploded[1]);
              $CFDIExploded = explode("Ini:4:",$fac);
              $CFDI = explode("Fin::Fin",$CFDIExploded[1]);
              $cadenaExploded = explode("Ini:5:",$fac);
              $cadena = explode("Fin::Fin",$cadenaExploded[1]);
              $certSATExploded = explode("Ini:6:",$fac);
              $certSAT = explode("Fin::Fin",$certSATExploded[1]);
              $certCFDIExploded = explode("Ini:7:",$fac);
              $certCFDI = explode("Fin::Fin",$certCFDIExploded[1]);
              $UUIDExploded = explode("Ini:8:",$fac);
              $UUID = explode("Fin::Fin",$UUIDExploded[1]);
              $selloSATExploded = explode("Ini:9:",$fac);
              $selloSAT = explode("Fin::Fin",$selloSATExploded[1]);
              $fechaExploded = explode("Ini:10:",$fac);
              $fecha = explode("Fin::Fin",$fechaExploded[1]);
              $totExploded = explode("Ini:11:",$fac);
              $tot = explode("Fin::Fin",$totExploded[1]);
              $totLExploded = explode("Ini:12:",$fac);
              $totL = explode("Fin::Fin",$totLExploded[1]);
              $qrExploded = explode("Ini:13:",$fac);
              $qr = explode("Fin::Fin",$qrExploded[1]);
              $timbrado = array($status[0], $message[0], $noCert[0], $sello[0], $CFDI[0], $cadena[0], $certSAT[0], $certCFDI[0], $UUID[0], $selloSAT[0], $fecha[0], $tot[0], $totL[0], $qr[0]);

              $doc_timbrado = new Gos_Docventa_Timbrado();
              $doc_timbrado->gos_docventa_id = $doc_venta_id;
              $doc_timbrado->status = $timbrado[0];
              $doc_timbrado->mensaje = $timbrado[1];
              $doc_timbrado->noCert = $timbrado[2];
              $doc_timbrado->sello = $timbrado[3];
              $doc_timbrado->CFDI = $timbrado[4];
              $doc_timbrado->cadena = $timbrado[5];
              $doc_timbrado->certSAT = $timbrado[6];
              $doc_timbrado->certCFDI = $timbrado[7];
              $doc_timbrado->UUID = $timbrado[8];
              $doc_timbrado->selloSAT = $timbrado[9];
              $doc_timbrado->fecha = $timbrado[10];
              $doc_timbrado->total = $timbrado[11];
              $doc_timbrado->totalLetra = $timbrado[12];
              $doc_timbrado->qr = $timbrado[13];
              $doc_timbrado->save();
              $gosVenta = Gos_Docventa::find($doc_venta_id);
              $gosVenta->uuid = $timbrado[8];
              $gosVenta->save();
              return back()->with('success', "REP Generado con éxito");
          }
        }
        else{
          return back()->with('alert', "Para generar un REP tiene que ser el mismo RFC en las facturas seleccionadas.");
        }
      }
      else{
        return back()->with('alert', "Selecciona al menos una factura");
      }

    }
    public function nuevaVentaMostrador(){
      $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();
      $listaServicios = Gos_V_Paq_Servicios::where('gos_taller_id',Session::get('taller_id'))->get();
      $listaPaquetes = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->get();
      $listaProductos = Gos_Producto::where('gos_taller_id',Session::get('taller_id'))->get();
      $compact=compact('listaEtapas', 'listaServicios', 'listaPaquetes','listaProductos');

      return view('Facturacion/ventaMostrador',$compact);

    
    }
}
