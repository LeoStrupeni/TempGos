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

class ReporteComprasController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listadoProveedores=Gos_V_Proveedor::where(self::condIdTaller())->get();
        $listadoFormasPago=Gos_Forma_Pago::all();
        $listadoTipoCompra=Gos_Compra_Tipo::all();

        $fechamin = date('Y-m-01'); 
        $fechamax = date("Y-m-t");

        // $listadoTabla = Gos_V_Reporte_Compras::where(self::condIdTaller())
        //                                         ->whereBetween('fecha_compra',[$fechamin,$fechamax])
        //                                         ->get();
        // $ajax = $this->preparaDataTableAjax($listadoTabla, '');
        // if (null !== $ajax) {
        //     return $ajax;
        // }

        return view('/Reportes/ReporteCompras', compact('listadoProveedores','listadoFormasPago','listadoTipoCompra'));
    }

    public function setTabla(Request $request)
    {
        $fechamin = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,0,10))) : date('Y-m-01');
        $fechamax = isset($request->rangoFechas) ? date("Y-m-d", strtotime(substr($request->rangoFechas,14,10))) : date("Y-m-t");      

        $tabla = Gos_V_Reporte_Compras::where(self::condIdTaller())
                                            ->whereBetween('fecha_compra',[$fechamin,$fechamax])
                                            ->get();
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