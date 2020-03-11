<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_V_Proveedor;
use App\Gos\Gos_Forma_Pago;
use App\Gos\Gos_Compra_Tipo;
use App\Gos\Gos_V_Reporte_Compras;

use \Response;
use Session;

class ReportePorPagarProvController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_vencimiento = date('m/t/Y');

        $idtaller=Session::get('taller_id');
        $listaProveedores = Gos_V_Proveedor::where('gos_taller_id',$idtaller)
                                            ->where('saldo_pdte','>','0')
                                            ->orderby('saldo_pdte','desc')
                                            ->get();

        $listaCompras = Gos_V_Reporte_Compras::where('gos_taller_id',$idtaller)
                                            ->where('Saldo','>','0')
                                            ->orderby('fecha_compra','asc')
                                            ->get();

        $proveedores = Gos_V_Proveedor::where('gos_taller_id',$idtaller)->get();

        return view('/Reportes/ReportePorPagarProveedor',compact('listaProveedores','listaCompras','fecha_vencimiento','proveedores'));
    }

    public function indexFiltros(Request $request){
               
        $fecha_Venc1 = date("Y-m-d",strtotime($request->fecha_vencimiento));

        $filtroProveedores = null;

        foreach ($request->proveedor as $prov) {
            $filtroProveedores = $filtroProveedores."'".$prov."',";
        }    
               
        $filtroProveedores = trim($filtroProveedores,',');

        $fecha_vencimiento = $request->fecha_vencimiento;

        $idtaller=Session::get('taller_id');
        $listaProveedores = DB::select(DB::raw(
        "SELECT P.gos_proveedor_id,P.nomb_proveedor,P.gos_taller_id,P.contacto,P.telefono,P.email,
                P.total_pdte,P.nombreProveedor,C.saldo_pdte
        FROM gos_v_proveedor P           
        INNER JOIN (SELECT gos_proveedor_id,SUM(Saldo) as saldo_pdte
                    FROM gos_v_reporte_compras
                    WHERE gos_taller_id = '".$idtaller."'
                    AND Saldo > 0
                    AND (fecha_pago <= '".$fecha_Venc1."' OR fecha_pago IS NULL)
                    GROUP BY gos_proveedor_id) C 
        ON C.gos_proveedor_id = P.gos_proveedor_id
        WHERE P.gos_taller_id = '".$idtaller."'
        AND P.gos_proveedor_id IN (".$filtroProveedores.")
        ORDER BY C.saldo_pdte DESC"
        )); 

        $listaCompras = DB::select(DB::raw(
                "SELECT *
                FROM gos_v_reporte_compras
                WHERE gos_taller_id = '".$idtaller."'
                AND Saldo > 0
                AND (fecha_pago <= '".$fecha_Venc1."' OR fecha_pago IS NULL)
                ORDER BY fecha_compra ASC"
        ));

        $proveedores = Gos_V_Proveedor::where('gos_taller_id',$idtaller)->get();

        $provFiltros = $request->proveedor;

        return view('/Reportes/ReportePorPagarProveedor',compact('listaProveedores','listaCompras','fecha_vencimiento','proveedores','provFiltros'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
