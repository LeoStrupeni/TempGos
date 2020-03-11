<?php
namespace App\Http\Controllers\Gos\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\Reportes;
use App\GosClases\GosUtil;

/**
 * Clase padre con funciones comunes a los reportes
 *
 * @author yois
 *
 */
class ReportesMasterController extends GosControllers
{

    private $compact;

    /**
     *
     * @return the $compact
     */
    public function getCompact()
    {
        return $this->compact;
    }

    /**
     *
     * @param field_type $compact
     */
    public function setCompact($compact)
    {
        $this->compact = $compact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compact = Reportes::listasSeleccionFiltrado();
        $this->setCompact($compact);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* YOIS */
    /**
     * aplica filtro de busquda
     *
     * @return string
     */
    public function aplicaFiltro($request)
    {
        $filtros = $this->preparaFiltros($request);
        $this->actualizaReporte($filtros);
        return view($this->getVistaListado(), $this->actualizaReporte($filtros));
    }

    /**
     * prepara filtro de busqueda
     *
     * @param unknown $request
     * @return string
     */
    protected function preparaFiltros($request)
    {
        $gos_aseguradora_id = $request->gos_aseguradora_id;
        $gos_os_tipo_o_id = $request->gos_os_tipo_o_id;
        $gos_os_tipo_danio_id = $request->gos_os_tipo_danio_id;
        $gos_os_estado_exp_id = $request->gos_os_estado_exp_id;
        $fechaDesde = GosUtil::convierteFechaHaciaMySQLFormat($request->fechaDesde);
        $fechahasta = GosUtil::convierteFechaHaciaMySQLFormat($request->fechahasta);
        //
        $filtros = [];
        // tipo cliente/ aseguradora
        if ($gos_aseguradora_id != 0) {
            $filtros = array_merge($filtros, [
                'gos_aseguradora_id',
                '=',
                $gos_aseguradora_id
            ]);
        }
        // tipo de orden
        if ($gos_os_tipo_o_id != 0) {
            $filtros = array_merge($filtros, [
                'gos_os_tipo_o_id',
                '=',
                $gos_os_tipo_o_id
            ]);
        }

        // tipo de daño
        if ($gos_os_tipo_danio_id != 0) {
            $filtros = array_merge($filtros, [
                'gos_os_tipo_danio_id',
                '=',
                $gos_os_tipo_danio_id
            ]);
        }

        // estado expediente
        if ($gos_os_estado_exp_id != 0) {
            $filtros = array_merge($filtros, [
                'gos_os_estado_exp_id',
                '=',
                $gos_os_estado_exp_id
            ]);
        }

        dd($filtros);
        return $filtros;
    }

    /**
     *
     * @param array $filtros
     */
    protected function actualizaReporte($filtros = array())
    {
        //
    }
    /* YOIS */
}
