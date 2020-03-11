<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Color;
use App\Gos\Gos_V_Vehiculos;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_Vehiculo_Cilindro;
use App\Gos\Gos_Vehiculo_Marca;
use App\Gos\Gos_Vehiculo_Modelo;
use App\Gos\Gos_Vehiculo_Nro_Puertas;
use App\Gos\Gos_Vehiculo_Tipo_Comb;
use App\Gos\Gos_Taller_Conf_vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Response;
use Session;

/**
 *
 * @author yois
 *        
 */
class VehiculosController extends GosControllers
{

    protected $vistaListado = 'Vehiculos/ListarVehiculos';

    protected $opcionesEditDataTable = 'Vehiculos.OpcionesVehiculosDataTable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaVehiculos = self::listadoGeneral();
        $variables = $this->preparaCrearEditar();
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $compact = array_merge($variables, compact('listaVehiculos','taller_conf_vehiculo'));
        /**
         * preparar ajax
         */
        $ajax = $this->preparaDataTableAjax($listaVehiculos, $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        // dd($listaVehiculos);
        //
        return view($this->getVistaListado(), $compact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return self::preparaCrearEditar();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        // inicializo vehiculo
        $vehiculo = null;
        // select de clientes
        $listaClientes = ClientesController::listaMinClientes();
        // selects de vehiculos
        $selectsVehiculo = $this->obtenSelectsVehiculo();
        // selects de regiones
        $listaRegiones = $this->obtenListaSelectRegiones();
        // dd($colores);
        //
        $compact = array_merge(compact('vehiculo', 'listaClientes'), $selectsVehiculo, $listaRegiones);
        return $compact;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
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
        $vechiculo = $this->preparaDatos($request);
        return Response::json($vechiculo);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos($request)
    {
        $vehiculo = null;
        $gos_vehiculo_id = isset($request->gos_vehiculo_id) ? $request->gos_vehiculo_id : 0;
        $datos = $this->datosEntidad($request);
        if ($gos_vehiculo_id > 0) {
            $vehiculo = Gos_Vehiculo::find($gos_vehiculo_id)->update($datos);
        } else {
            $vehiculo = new Gos_Vehiculo($datos);
            $vehiculo->save();
        }
        return $vehiculo;
    }

    /**
     *
     * @param unknown $request            
     * @return unknown[]|NULL[]|string[]
     */
    protected function datosEntidad($request)
    {
        // dd($request);
        //
        $placa = $this->placa($request);
        $nro_serie = $this->nro_serie($request);
        $fecha_importacion = $this->fechaImportacion($request);
        //
        $gos_vehiculo_modelo_id = isset($request->gos_vehiculo_modelo_id) ? $request->gos_vehiculo_modelo_id : 0;
        $tipo_combustible = isset($request->tipo_combustible) ? $request->tipo_combustible : 0;
        $vehiculo_cilindros = isset($request->vehiculo_cilindros) ? $request->vehiculo_cilindros : 0;
        $nro_puertas = isset($request->nro_puertas) ? $request->nro_puertas : 0;
        //
        $color_interior = isset($request->color_interior) ? $request->color_interior : '000000';
        $color_vehiculo = isset($request->color_vehiculo) ? $request->color_vehiculo : '000000';
        //
        $datos = [
            // 'gos_paq_etapa_id' => $request->gos_paq_etapa_id,
            'gos_cliente_id' => $request->gos_cliente_id,
            'gos_vehiculo_modelo_id' => $gos_vehiculo_modelo_id,
            'anio_vehiculo' => $request->anio_vehiculo,
            'color_vehiculo' => $color_vehiculo,
            'placa' => $placa,
            'economico' => $request->economico,
            'nro_serie' => $nro_serie,
            'tipo_combustible' => $tipo_combustible,
            'vehiculo_cilindros' => $vehiculo_cilindros,
            'nro_motor' => $request->nro_motor,
            'nro_serie' => $nro_serie,
            'observaciones' => $request->observaciones,
            'nro_puertas' => $nro_puertas,
            'pasajeros' => $request->pasajeros,
            'color_interior' => $color_interior,
            'procedencia' => $request->procedencia,
            'aduana' => $request->aduana,
            'fecha_importacion' => $fecha_importacion,
            'cilindraje' => $request->cilindraje,
            'anexo' => $request->anexo
        ];
        return $datos;
    }
    public function modeloLista($id){
        
        $userData['data'] = Gos_Vehiculo_Modelo::where('gos_vehiculo_marca_id',$id)->get();

        echo json_encode($userData);
        exit;
    }
    /**
     *
     * @param unknown $request            
     * @return string
     */
    private function fechaImportacion($request)
    {
        return self::convierteFechaHaciaMySQLFormat($request->fecha_importacion);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::validaDatos()
     */
    protected function validaDatos(Request $request)
    {
        // $campos = $request->all();
        $reglas = [
            'gos_vehiculo_id' => 'required',
            'color_vehiculo' => 'required',
            'placa' => 'required',
            'nro_serie' => 'required',
            'tipo_combustible' => 'required',
            'vehiculo_cilindros' => 'required',
            'nro_motor' => 'required',
            'nro_puertas' => 'required',
            'color_interior' => 'required'
        
        ];
        $mensajes = [
            'gos_vehiculo_id.required' => 'Debe elegir un cliente',
            'placa' => 'Debe escribir la placa',
            'color_vehiculo' => 'Falta color del vehiculo',
            'nro_serie' => 'Falta número de serie',
            'tipo_combustible' => 'Falta tipo de combustible',
            'vehiculo_cilindros' => 'Falta cilindros',
            'nro_motor' => 'Falta número de motor',
            'nro_puertas' => 'Falta número de puertas',
            'color_interior' => 'Falta color interior '
        
        ];
        // realizar validacion
        return $this->validate($request, $reglas, $mensajes);
    }

    /**
     *
     * @param
     *            request
     */
    private function nro_serie($request)
    {
        $nro_serie = $request->nro_serie;
        return $nro_serie;
    }

    /**
     *
     * @param
     *            request
     */
    private function placa($request)
    {
        /**
         *
         * @var \App\Gos\Gos_Vehiculo $vechiculo datos del vehiculo
         */
        $placa = $request->placa;
        return $placa;
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
        // fija entidad ID para uso global en todos los metdos y funciones de la clase
        $this->setEntidad_id($id);
        // si el id de vehiculo es <> a cero
        if ($this->getEntidad_id() !== 0)
            // obtiene los datos de la entidad o se ael veiculo
            $this->setEntidad(Gos_V_Vehiculos::find($this->getEntidad_id()));
        // asigna entidad a la variable vehiculo
        $vehiculo = $this->getEntidad();
        // si se devuelve un registro
        if ($vehiculo instanceof Gos_V_Vehiculos) {
            // convertire fecha de importacion
            $fecha_importacion = $vehiculo->fecha_importacion;
            $vehiculo->fecha_importacion = $this->convierteFechaDesdeMySQLFormat($fecha_importacion);
            //
            // devolver datos del registro
            return Response::json($vehiculo);
        } else
            return Response::json('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $vechiculo, $id)
    {
        // dd($request);
        return $this->guardaJson($vechiculo, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_vehiculo_id)
    {
        $vehiculo = Gos_Vehiculo::find($gos_vehiculo_id);
        $vehiculo->delete();
        return Response::json($vehiculo);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        $condIdTaller = self::condIdTaller();
        return Gos_V_Vehiculos::where($condIdTaller);
    }

    /**
     * Permite leer archivo excel importado
     * Se llama desde la vista modal FileUploadVehiculos
     * Gos\VehiculosController@cargaVehiculosDesdeExcel/nombreArchivoXLS
     */
    public function cargaVehiculosDesdeExcel($nombreArchivoXLS)
    {
    /**
     * Leer archivo desde carpeta public/uploads/$nombreArchivoXLS.xls
     */
        // recorrer archivo completo desde inicio a fin y cargar los datos en base de datos
    
    /**
     * CAMPOS:
     * gos_vehiculo_id int(11) AI PK
     * gos_vehiculo_id int(11)
     * gos_vehiculo_modelo_id int(11)
     * year varchar(255)
     * color varchar(255)
     * placa varchar(255)
     * economico varchar(255)
     * nro_serie varchar(255)
     * tipo_combustible int(11)
     * vehiculo_cilindros int(11)
     * cilindraje varchar(255)
     * nro_puertas smallint(6)
     * nro_motor varchar(255)
     * observaciones varchar(255)
     * anexo varchar(255)
     * color_interior varchar(255)
     * procedencia varchar(255)
     * aduana varchar(255)
     * fecha_importacion date
     */
        // retorna a la pagina de ista de vehiculos
    }
    public function vehiculosClientes($gos_cliente_id){
        $listaOS = Gos_V_Vehiculos::where('gos_cliente_id', $gos_cliente_id)->get();
        $ajax = $this->preparaDataTableAjax($listaOS, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
    }
}
