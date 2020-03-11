<?php

namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;

use GosClases\ReporteCorteDiario;
use App\Gos\Gos_V_Reporte_Corte_Diario;
use \Response;
use Session;


class ReporteCorteDiarioController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // llamada al metodo padre
        parent::index();

        $fechamin = date('Y-m-01'); 
        $fechamax = date("Y-m-t");

        $listadoTabla = Gos_V_Reporte_Corte_Diario::where(self::condIdTaller())
                                                            ->whereBetween('fecha',[$fechamin,$fechamax])
                                                            ->get();
        // dd($listadoTabla);
        $ajax = $this->preparaDataTableAjax($listadoTabla, '');
        if (null !== $ajax) {
            return $ajax;
        }
      
        $compat1 = $this->getCompact();
        $compact = compact('listadoTabla');     
        $compactFinal = array_merge($compat1, $compact);


        return view('/Reportes/ReporteCorteDiario', $compactFinal);
    }

    public function setTabla(Request $request)
    {
        $fechamin = date("Y-m-d", strtotime(substr($request->rangoFechas,0,10)));
        $fechamax = date("Y-m-d", strtotime(substr($request->rangoFechas,14,10)));

        $tipo = $request->tipo;
 
        $tabla = Gos_V_Reporte_Corte_Diario::where(self::condIdTaller())
                                            ->whereBetween('fecha',[$fechamin,$fechamax])
                                            ->FilterType($tipo)
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
