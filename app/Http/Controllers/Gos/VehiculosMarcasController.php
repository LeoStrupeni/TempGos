<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Vehiculo_Marca;
Use \Response;
Use Session;
use App\Gos\Gos_Taller_Conf_vehiculo;

/**
 *
 * @author yois
 *        
 */
class VehiculosMarcasController extends GosControllers
{

    protected $vistaListado = 'Vehiculos/ListarMarcasVehiculos';

    protected $opcionesEditDataTable = 'Vehiculos.OpcionesMarcasDataTable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * preparar ajax
         */
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $ajax = $this->preparaDataTableAjax(self::listadoGeneral(), $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado())->with(compact('taller_conf_vehiculo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $compact = $this->preparaCrearEditar();
        // return view('Vehiculos/EditarMarcaVehiculo', $compact);
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
        return Response::json($this->preparaDatos($request));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos(Request $request)
    {
        $marca = null;
        $gos_vehiculo_marca_id = isset($request->gos_vehiculo_marca_id) ? $request->gos_vehiculo_marca_id : 0;

        $datos = $this->datosEntidad($request);

        if ($gos_vehiculo_marca_id !== 0) {
            Gos_Vehiculo_Marca::find($gos_vehiculo_marca_id)->update($datos);
        } else {
            $marca = new Gos_Vehiculo_Marca($datos);
            $marca->save();
            $gos_vehiculo_marca_id = $marca->gos_vehiculo_marca_id;
        }
        $this->setEntidad_id($gos_vehiculo_marca_id);
        //
        return $marca;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        /**
         * Table: Gos_Vehiculo_Marca
         * Columns:
         * gos_vehiculo_marca_id int(11) AI PK
         * marca_vehiculo varchar(20)
         */
        return [
            // 'relacion_id' => $request->gos_paq_etapa_id,
            'gos_taller_id' => Session::get('taller_id'),
            'marca_vehiculo' => $request->marca_vehiculo
        ];
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $gos_id_cliente            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_vehiculo_marca_id)
    {
        $this->setEntidad_id($gos_vehiculo_marca_id);
        $where = array('gos_vehiculo_marca_id' => $gos_vehiculo_marca_id);
        $marca = Gos_Vehiculo_Marca::where($where)->first();
        
        return Response::json($marca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $gos_id_cliente            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $gos_id_cliente            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_vehiculo_marca_id)
    {
        $marca_vehiculo = Gos_Vehiculo_Marca::find($gos_vehiculo_marca_id);
        $marca_vehiculo->delete();
        return Response::json($marca_vehiculo);
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        // Traer informacion de clase marca

       $condIdTaller=Session::get('taller_id');
        return Gos_Vehiculo_Marca::where('gos_taller_id',$condIdTaller );
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $id = $this->getEntidad_id();
        $marca = null;
        if ($id !== 0) {
            $marca = Gos_Vehiculo_Marca::find($id);
        }
        return compact('marca');
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::validaDatos()
     */
    protected function validaDatos(Request $request)
    {
        /**
         *
         * @var string $nombre
         */
        $nombre = $request->get('marca_vehiculo');
        $reglas = [
            'marca_vehiculo' => 'required|unique:gos_marca_vehiculo,marca_vehiculo'
        
        ];
        $mensajes = [
            'marca_vehiculo.required' => 'Falta marca'
        ];
        
        return $this->validate($request, $reglas, $mensajes);
        //
    }

    

}
