<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Ot;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Region_Colonia;
use App\Gos\Gos_Region_Municipio;
use App\Gos\Gos_Region_Estado;
use \Response;
use Illuminate\Validation\Validator;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_V_Otros_Talleres;

/**
 *
 * @author yois
 *        
 */
class OtroTallerController extends GosControllers
{

    protected $vistaListado = 'TOT/ListarTOT';

    protected $opcionesEditDataTable = 'TOT.OpcionesDataTable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaOtroTaller = $this->listadoGeneral();
        //
        $compact = array_merge($this->preparaCrearEditar(), compact('listaOtroTaller'));
        /**
         * preparar ajax
         */
        //
        $ajax = $this->preparaDataTableAjax($listaOtroTaller, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), $compact);
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Otros_Talleres::where(self::condIdTaller())->get();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        /**
         *
         * @var integer $gos_ot_id
         */
        $gos_ot_id = $this->getEntidad_id();
        $ot = null;
        //
        if ($gos_ot_id !== 0) {
            $ot = $this->setEntidad(Gos_Ot::find($gos_ot_id));
        }
        // regiones
        $listaRegiones = $this->obtenListaSelectRegiones();
        //
        return $listaRegiones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TOT/EditarTOT');
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
        //
        $otroTaller = $this->preparaDatos($request);
        return Response::json($otroTaller);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos(Request $request)
    {
        $gos_ot_id = isset($request->gos_ot_id) ? $request->gos_ot_id : 0;
        $ot = null;
        $datos = $this->datosEntidad($request);
        //
        // dd($datos);
        if ($gos_ot_id > 0) {
            $ot = Gos_Ot::find($gos_ot_id)->update($datos);
        } else {
            $ot = new Gos_Ot($datos);
            $ot->save();
        }
        return $ot;
    }

    /**
     *
     * @param unknown $request            
     * @return \App\Gos\Gos_Cliente
     */
    protected function datosEntidad($request)
    {
        /**
         *
         * @var Ambiguous $gos_region_colonia_id
         */
        $gos_region_ciudad_id = isset($request->gos_region_ciudad_id) ? $request->gos_region_ciudad_id : 0;
        $ot = [
            'gos_taller_id' => self::tallerIdActual(),
            'gos_region_ciudad_id' => $gos_region_ciudad_id,
            'ot_municipio' => $request->ot_municipio,
            'ot_localidad' => $request->ot_localidad,
            'nomb_ot' => $request->nomb_ot,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'cp' => $request->cp
        ];
        
        //
        return $ot;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Ot $gos_Ot            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Ot $gos_Ot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Ot $gos_Ot            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_ot_id)
    {

        $this->setEntidad_id($gos_ot_id);
        $tot = Gos_V_Otros_Talleres::find($gos_ot_id);
        return Response::json($tot);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Ot $gos_Ot            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Ot $gos_Ot)
    {
        //
        return Response::json($this->preparaDatos($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Ot $gos_Ot            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_ot_id)
    {
        $otro_taller = Gos_Ot::find($gos_ot_id);
        $otro_taller->delete();
        return Response::json($otro_taller);
    }
}
