<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Gos\Gos_Vehiculo_Modelo;
use App\Gos\Gos_V_Vehiculos_Modelos_Marcas;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Taller_Conf_vehiculo;


Use Session;
/**
 *
 * @author yois
 *        
 */
class VehiculosModelosController extends GosControllers
{

    protected $vistaListado = 'Vehiculos/ListarModelosVehiculos';

    protected $opcionesEditDataTable = 'Vehiculos.OpcionesModelosDataTable';

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
        $compact = $this->preparaCrearEditar();
        
        return view($this->getVistaListado(), $compact)->with(compact('taller_conf_vehiculo'));
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
        // $this->validaDatos($request);
        $modelo = null;
        $gos_vehiculo_modelo_id = isset($request->gos_vehiculo_modelo_id) ? $request->gos_vehiculo_modelo_id : 0;
        
        $datos = $this->datosEntidad($request);
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        
        if ($gos_vehiculo_modelo_id > 0) {
            Gos_Vehiculo_Modelo::find($gos_vehiculo_modelo_id)->update($datos);
        } else {
            $modelo = new Gos_Vehiculo_Modelo($datos);
            $modelo->save();
            $gos_vehiculo_modelo_id = $modelo->gos_vehiculo_modelo_id;
        }
        
        $this->setEntidad_id($gos_vehiculo_modelo_id);
        
        return $modelo;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        return [
            'gos_vehiculo_marca_id' => $request->gos_vehiculo_marca_id,
            'modelo_vehiculo' => $request->modelo_vehiculo
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Vehiculo_Modelo $gos_Vehiculo_Modelo            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     *
     * @param unknown $gos_vehiculo_modelo_id            
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($gos_vehiculo_modelo_id)
    {
        $this->setEntidad_id($gos_vehiculo_modelo_id);
        $where = array(
            'gos_vehiculo_modelo_id' => $gos_vehiculo_modelo_id
        );
        $modelo = Gos_Vehiculo_Modelo::where($where)->first();
        
        return Response::json($modelo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Vehiculo_Modelo $gos_Vehiculo_Modelo            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Vehiculo_Modelo $gos_Vehiculo_Modelo            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_vehiculo_modelo_id)
    {
        $modelo = Gos_Vehiculo_Modelo::find($gos_vehiculo_modelo_id);
        $modelo->delete();
        return Response::json($modelo);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {

       $condIdTaller=Session::get('taller_id');
        return Gos_V_Vehiculos_Modelos_Marcas::where('gos_taller_id', $condIdTaller);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
       $condIdTaller=Session::get('taller_id');
        $gos_vehiculo_modelo_id = $this->getEntidad_id();
        $modelo = null;
        //
        if ($gos_vehiculo_modelo_id !== 0) {
            $modelo = Gos_Vehiculo_Modelo::find($gos_vehiculo_modelo_id);
        }
        $listaMarcasVehiculos = Gos_Vehiculo_Marca::where('gos_taller_id', $condIdTaller)->get();
        
        return compact('listaMarcasVehiculos');
    }

    protected function validaDatos(Request $request)
    {
        /**
         *
         * @var string $nombre
         */
        $nombre = $request->get('modelo_vehiculo');
        $reglas = [
            'modelo_vehiculo' => 'required|unique:gos_vehiculo_modelo,modelo_vehiculo'
        
        ];
        $mensajes = [
            'modelo_vehiculo.required' => 'Falta marca'
        ];
        
        return $this->validate($request, $reglas, $mensajes);
        //
    }
}
