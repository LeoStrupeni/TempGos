<?php
namespace App\Http\Controllers\Gos;

//
use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Gos\Gos_V_Clientes_Vehiculos;
use App\Gos\Gos_V_Clientes_;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Cliente_Factura;
use App\Gos\Gos_Cliente_Cond_Credito;
use App\Gos\Gos_V_Min_Clientes;
use App\Gos\Gos_V_Clientes;
use App\Gos\Gos_Region_Ciudad;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use Session;

/**
 *
 * @author yois
 *
 */
class ClientesController extends GosControllers
{

    protected $vistaListado = 'Clientes/ListarClientes';

    protected $opcionesEditDataTable = 'Clientes.OpcionesClientesDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**
         * Funcion que carga los datos de la lista General en el DAtatable y utiliza
         * $opcionesEditDataTable como opciones para edtiar/borrar que estan dentro del archivo
         * declarado en la variable $opcionesEditDataTable.
         *
         * @var Ambiguous $ajax
         */
        $usuario_id = Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario_id->gos_taller_id)->first();

        $ajax = $this->preparaDataTableAjax(self::listadoGeneral(), $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        /**
         * Variable que trae listas para selects de modales
         *
         * @var Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static > $listaClientes
         */
        $compact = $this->preparaCrearEditar();
        /**
         * famoso view
         */
        return view($this->getVistaListado(), $compact)->with(compact('taller_conf_vehiculo','taller_conf_ase'));
    }

    /**
     * funcion que trae de la BD la lista general de la vista
     *
     * @param string $criterio
     * @return unknown
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Clientes::where(self::condIdTaller())->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compact = $this->preparaCrearEditar();
        $vistaEdicion = 'Clientes/EditarCliente';
        return view($vistaEdicion, $compact);

    /**
     * COMENTARIOS LEO
     * La informacion $listaEstados esta enviada en $listaMunicipios, no es conveniente usar solo $listaMunicipios?
     * Se necesita:
     * $listaTipoPersonas de "gos_fac_tipo_persona"
     * $listaLocalidades de "c_localidad"
     * $cliente se necesita sumar en "Gos_V_Clientes" los datos de "gos_cliente_factura"
     *
     * LA PARTE DE CLIENTE CONFIGURACION NO LA VI COMPLETA, SOLO ACOMODE EL CODIGO
     *
     * La parte de vehiculo, necesito la misma informacion que te deje detallada en yois.todo de vehiculo
     */
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
        // return($request);
        /**
         * Guardar ENTIDAD PRINCIAL
         *
         * @var Ambigous <NULL, \App\Gos\Gos_Cliente> $cliente
         */
        $cliente = $this->preparaDatos($request);
        /**
         * Guardar DAtos relacionados
         */
        
        // $idtaller=Session::get('taller_id');
        // $cliente = new Gos_Cliente;
        $facturacioncliente = $this->guardaDatosFacturacion($request);
        // return($cliente);
        // $cliente->save();
        // return($facturacioncliente);
        /**
         * Guardar entidad 1
         * Gaurdar entidad 2
         */
        /**
         * devolver resultados
         */
        
        return Response::json($facturacioncliente);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos(Request $request)
    {
        $idtaller=Session::get('taller_id');
        $cliente = null;
        $gos_cliente_id = isset($request->gos_cliente_id) ? $request->gos_cliente_id : 0;
        /**
         * Obenter datos de la entidad
         *
         * @var Ambiguous $datos
         */
        $datos = $this->datosEntidad($request);
        // si tiene ID
        if ($gos_cliente_id > 0) {
            $cliente = Gos_Cliente::find($gos_cliente_id)->update($datos);
        } else {
            // creao y guardo datos de la etapa asesor
            $repetido = Gos_Cliente::where('nombre',$request->nombre)->where('apellidos',$request->apellidos)->where('gos_taller_id',$idtaller)->first();
            
            if($repetido == null){
                $cliente = new Gos_Cliente($datos);                
                $cliente->save();
                $gos_cliente_id = $cliente->gos_cliente_id;
            }
        }
        /**
         * obtener ID de la entidad principal
         * Para ser usada en toda la clase
         */
        $this->setEntidad_id($gos_cliente_id);
        //
        return $cliente;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::guardaDatosFacturacion()
     */
    protected function guardaDatosFacturacion($request)
    {
        $f = null;
        // return($request);
        /**
         * id tomado desde la Entidad ID que ya se asigno en otro lado
         * fuera de esta funcion
         *
         * @var Ambiguous $relacion_id
         */
        $relacion_id = $this->getEntidad_id();
        /**
         * prepara los datos de facturaion
         *
         * @var unknown $datos
         */
        $datos = $this->datosFacturacion($request);
        if (! Gos_Cliente_Factura::find($relacion_id)) {
            $f = new Gos_Cliente_Factura($datos);
            $f->save();
        } else {
            $f = Gos_Cliente_Factura::where('relacion_id', $relacion_id)->update($datos);
        }
        return $f;
    }

    /**
     *
     * @param unknown $request
     * @return NULL|\App\Gos\Gos_Cliente_Cond_Credito
     */
    protected function guardaCondCredito($request)
    {
        $cc = null;
        $relacion_id = $this->getEntidad_id();
        $datos = $this->datosCondCredito($request);
        if (! Gos_Cliente_Cond_Credito::find($relacion_id)) {
            $cc = new Gos_Cliente_Cond_Credito($datos);
            $cc->save();
        } else {
            $cc = Gos_Cliente_Cond_Credito::where('relacion_id', $relacion_id)->update($datos);
        }
        return $cc;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::validaDatos()
     */
    protected function validaDatos(Request $request)
    {
        // request()->validate([
        // 'nombre' => 'required',
        // 'apellidos' => 'required'
        // ],
        // [
        // 'nombre.required' => 'nombre',
        // 'apellidos.required' => 'apellidos'
        // ]);
        /**
         *
         * @var string $nombre $nombre = $request->nombre;
         *      $apellidos = $request->apellidos;
         *      $campos = $request->all();
         *
         *
         *      $gos_cliente_id = $request->gos_proveedor_id;
         *      // dd($relacion_id);
         *      $reglas = [
         *      'nombre' => 'required|unique:gos_cliente,nombre,' . $gos_cliente_id . ',gos_paq_etapa_id',
         *      'apellidos' => 'required|unique:gos_cliente,apellidos,' . $gos_cliente_id . ',gos_paq_etapa_id',
         *      'email_cliente' => 'required|unique:gos_cliente,email_cliente,' . $gos_cliente_id . ',gos_paq_etapa_id'
         *      ];
         *
         *      $mensajes = [
         *      'nombre.required' => 'Falta nombre',
         *      'nombre.unique' => 'Nombre ya existe',
         *      'apellidos.required' => 'Falta apellidos',
         *      'apellidos.unique' => 'Apellidos y existe',
         *      'email_cliente.required' => 'Falta email',
         *      'email_cliente.unique' => 'Direccion de email ya existe. Por favor usa otra'
         *      ];
         */
        $nombre = $request->nombre;
        $apellidos = $request->apellidos;
        $campos = $request->all();

        // dd($campos);
        /**
         *
         * @var Ambiguous $relacion_id
         */
        $gos_cliente_id = $request->gos_cliente_id;
        // dd($relacion_id);
        $reglas = [
            'nombre' => 'required|unique:gos_cliente,nombre,' . $gos_cliente_id . ',gos_paq_etapa_id',
            'apellidos' => 'required|unique:gos_cliente,apellidos,' . $gos_cliente_id . ',gos_paq_etapa_id',
            'email_cliente' => 'required|unique:gos_cliente,email_cliente,' . $gos_cliente_id . ',gos_paq_etapa_id'
        ];
        /**
         *
         * @var array $mensajes
         */
        $mensajes = [
            'nombre.required' => 'Falta nombre',
            'nombre.unique' => 'Nombre ya existe',
            'apellidos.required' => 'Falta apellidos',
            'apellidos.unique' => 'Apellidos y existe',
            'email_cliente.required' => 'Falta email',
            'email_cliente.unique' => 'Direccion de email ya existe. Por favor usa otra'
        ];

        return $this->validate($request, $reglas, $mensajes);
        //
    }

    /**
     *
     * @param unknown $request
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        $gos_region_ciudad_id = isset($request->gos_region_ciudad_id) ? $request->gos_region_ciudad_id : 0;
        /**
         * preparar informacion a guarrdar
         */
        return [
            // 'relacion_id' => $request->gos_paq_etapa_id,
            'gos_taller_id' => self::tallerIdActual(),
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'empresa' => $request->empresa,
            'celular' => $request->celular,
            'telefono_fijo' => $request->telefono_fijo,
            'calle_nro' => $request->calle_nro,
            'codigo_postal' => $request->codigo_postal,
            'email_cliente' => $request->email_cliente,
            'saldo' => $request->saldo,
            'gos_region_ciudad_id' => $gos_region_ciudad_id,
            'cliente_localidad'=> $request->cliente_localidad,
            'cliente_municipio'=> $request->cliente_municipio
        ];
    }

    /**
     *
     * @param Request $request
     * @return mixed
     */
    private function clienteId(Request $request)
    {
        $gos_cliente_id = $request->gos_cliente_id;
        return $gos_cliente_id;
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
         * @var integer $cliente_id
         */
        $cliente_id = $this->getEntidad_id();
        $cliente = null;
        //
        if ($cliente_id !== 0) {
            $cliente = $this->setEntidad(Gos_V_Clientes_::find($cliente_id));
        }
        /**
         * lista de municipio, localidad, estado, etc
         *
         * @var array $listaRegiones
         */
        $listaRegiones = $this->obtenListaSelectRegiones();
        /**
         * listas de select para tipos de personas
         *
         * @var Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static > $listaTipoPersonas
         */
        $listaTipoPersonas = $this->listaTipoPersonaFactura();
        /**
         *
         * aramado de arreglo a devolver.
         *
         * @var array $compact
         */
        
        $compact = array_merge($listaRegiones, compact('cliente', 'listaTipoPersonas'));
        return $compact;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Cliente $gos_Cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Cliente $gos_Cliente)
    {
        //
    }

    /**
     *
     * @param Integer $relacion_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($gos_id_cliente)
    {
        $this->setEntidad_id($gos_id_cliente);
        // prepara y obtiene entidad
        $compact = $this->preparaCrearEditar();
        $cliente = $this->getEntidad();
        // si se devuelve un registro
        if ($cliente instanceof Gos_V_Clientes_) {
            // convertire fecha
            return Response::json($cliente);
        } else
            return Response::json('');
        //
    }
    public function ciudadLista($id){

        $userData['data'] = Gos_Region_Ciudad::where('gos_region_estado_id',$id)->get();

        echo json_encode($userData);
        exit;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gos\Gos_Cliente $gos_Cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Cliente $gos_Cliente)
    {
        return $this->guardaJson($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $gos_id_cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_cliente_id)
    {
        $cliente = Gos_Cliente::find($gos_cliente_id);
        $cliente->delete();
        return Response::json($cliente);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaMinClientes()
    {
        return Gos_V_Min_Clientes::where(self::condIdTaller())->get();
    }
}
