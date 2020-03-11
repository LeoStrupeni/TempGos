<?php
namespace App\Http\Controllers\Gos\OS;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\Anticipo;
use GosClases\GosDataTable;
use App\Gos\Gos_OS_Anticipo;

class AnticiposController extends GosControllers
{

    protected $opcionesEditDataTable = 'OS.Anticipo.OpcionesAnticipoDatatable';

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
        return $this->guardaJson($request);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::guardaJson()
     */
    protected function guardaJson(Request $request, $id = 0)
    {
        return Response::json(Anticipo::guardaDatosEntidad($request));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_os_id)
    {
        /**
         * lista
         *
         * @var Ambiguous $l
         */
        $l = Anticipo::otbtenAnticiposPorOS($gos_os_id);
        /**
         * opcones data table
         *
         * @var Ambiguous $op_dt
         */
        $op_dt = $this->getOpcionesEditDataTable();
        $json =  $this->preparaDataTableAjax($l, $op_dt);
        return $json;
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
        $os = Gos_OS_Anticipo::find($id);
        $os->delete();
        return Response::json($os);
    }
}
