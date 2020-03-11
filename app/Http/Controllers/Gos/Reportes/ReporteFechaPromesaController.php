<?php

namespace App\Http\Controllers\Gos\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_V_Fecha_Promesa;
use App\Gos\Gos_V_Fecha_Promesa_Cantidad;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Os;
use \Response;
use Session;

class ReporteFechaPromesaController extends ReportesMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaAsegurados = Gos_V_Fecha_Promesa::select('TipoClienteFiltro')->where(self::condIdTaller())->distinct()->orderby('TipoClienteFiltro')->get();
        $listaEtapasActivas = Gos_V_Fecha_Promesa::select('etapa_actual')->where(self::condIdTaller())->distinct()->orderby('etapa_actual')->get();
        $listadoTabla = Gos_V_Fecha_Promesa::where(self::condIdTaller())->get();
        $cantidadTiempos = Gos_V_Fecha_Promesa_Cantidad::where(self::condIdTaller())->get(); 
        
        $entiempo='0';
        $fueradeTiempo='0';
        $sinfechaPromesa='0';

        foreach ($cantidadTiempos as $cantidad) {
            if($cantidad->estado=='En Tiempo'){
                $entiempo = $cantidad->cantidad;
            } else if($cantidad->estado=='Fuera de tiempo'){
                $fueradeTiempo = $cantidad->cantidad;
            } else if($cantidad->estado=='Sin fecha promesa') {
                $sinfechaPromesa = $cantidad->cantidad;
            }
        }

        $ajax = $this->preparaDataTableAjax($listadoTabla,'');
        if (null !== $ajax) {
            return $ajax;
        }

   
        return view('/Reportes/ReporteFechasPromesa',compact('listaAsegurados','listaEtapasActivas','listadoTabla','entiempo','fueradeTiempo','sinfechaPromesa')); 
        // 'listadoTabla'
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
