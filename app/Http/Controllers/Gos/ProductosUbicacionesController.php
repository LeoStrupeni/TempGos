<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use Yajra\DataTables\EloquentDataTable;

use App\Gos\Gos_Producto_Ubicacion;

/**
 *
 * @author yois
 *        
 */
class ProductosUbicacionesController extends GosControllers
{
    protected $vistaListado = 'Ubicaciones/ListarUbicacion';

    protected $opcionesEditDataTable = 'Ubicaciones.OpcionesUbicacionDataTable';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listaUbicaciones = $this->listadoGeneral();

        $ajax = $this->preparaDataTableAjax($listaUbicaciones, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), compact('listaUbicaciones'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_Producto_Ubicacion::where(self::condIdTaller())->get();
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
        // $request->validate([
        //     'nomb_ubicacion' => 'required'
        // ]);
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
        $ubicacion = $this->preparaDatos($request);
        return Response::json($ubicacion);
    }

    /**
     *
     * @param
     *            request
     */
    protected function preparaDatos($request)
    {
        $ubicacion = null;
        $gos_producto_ubicacion_id = isset($request->gos_producto_ubicacion_id) ? $request->gos_producto_ubicacion_id : 0;
        $datos = $this->datosEntidad($request);
        if ($gos_producto_ubicacion_id > 0) {
            $ubicacion = Gos_Producto_Ubicacion::find($gos_producto_ubicacion_id)->update($datos);
        } else {
            $ubicacion = new Gos_Producto_Ubicacion($datos);
            $ubicacion->save();
            $gos_producto_ubicacion_id = $ubicacion->gos_producto_ubicacion_id;
        }

        $this->setEntidad_id($gos_producto_ubicacion_id);

        return $ubicacion;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        return [
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_ubicacion' => $request->nomb_ubicacion
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Ubicacion $Gos_Producto_Ubicacion            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Producto_Ubicacion $gos_producto_ubicacion_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Ubicacion $Gos_Producto_Ubicacion            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_producto_ubicacion_id)
    {
        $this->setEntidad_id($gos_producto_ubicacion_id);
        $ubicacion = Gos_Producto_Ubicacion::find($gos_producto_ubicacion_id);
        
        return Response::json($ubicacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Producto_Ubicacion $Gos_Producto_Ubicacion            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_producto_ubicacion_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto_Ubicacion $Gos_Producto_Ubicacion            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_producto_ubicacion_id)
    {
        $ubicacion = Gos_Producto_Ubicacion::find($gos_producto_ubicacion_id);
        $ubicacion->delete();
        return Response::json($ubicacion);
    }

    public static function cargaRapida(Request $request)
    {
        $ubicacion = new Gos_Producto_Ubicacion([
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_ubicacion' => $request->name
        ]);
        
        $ubicacion->save();
        $gos_producto_ubicacion_id = $ubicacion->gos_producto_ubicacion_id;
        return $gos_producto_ubicacion_id;
    }

}
