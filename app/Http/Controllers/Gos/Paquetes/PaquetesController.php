<?php
namespace App\Http\Controllers\Gos\Paquetes;

use App\Gos\Gos_Paquete;
use Illuminate\Http\Request;
use \Response;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\PaqueteOS;

/**
 *
 * @author yois
 *        
 */
class PaquetesController extends GosControllers
{

    protected $vistaListado = 'Paquetes/ListarPaquetes';

    protected $vistaEdicion = 'Paquetes.OpcionesPaquetesDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = PaqueteOS::preparaCrearEditar();
        $l = PaqueteOS::listadoGeneral();
        $a = self::preparaDataTableAjax($l, $this->getVistaEdicion());
        if (null !== $a) {
        return $a;
        }
        return view($this->getVistaListado(), $c);
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
        return Response::json(PaqueteOS::guardaEntidadPrincipal($request));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Paquete $gos_Paquete            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_paquete_id)
    {
        return PaqueteOS::obtenPaquete($gos_paquete_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Paquete $gos_Paquete            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_paquete_id)
    {
        return PaqueteOS::obtenPaquete($gos_paquete_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Paquete $gos_Paquete            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Paquete $gos_Paquete)
    {
        return PaqueteOS::guardaJson($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Paquete $gos_Paquete            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_paquete_id)
    {
        $p = PaqueteOS::borraPaquete($gos_paquete_id);
        return Response::json($p);
    }
}
