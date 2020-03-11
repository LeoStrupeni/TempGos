<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Region_Municipio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_V_Min_Municipios;
/**
 * 
 * @author yois
 *
 */

class MunicipiosController extends GosControllers
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Region_Municipio $gos_Region_Municipio            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Region_Municipio $gos_Region_Municipio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Region_Municipio $gos_Region_Municipio            
     * @return \Illuminate\Http\Response
     */
    public function edit(Gos_Region_Municipio $gos_Region_Municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Region_Municipio $gos_Region_Municipio            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Region_Municipio $gos_Region_Municipio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Region_Municipio $gos_Region_Municipio            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gos_Region_Municipio $gos_Region_Municipio)
    {
        //
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaMinMunicipio()
    {
        return Gos_V_Min_Municipios::all();
    }
}
