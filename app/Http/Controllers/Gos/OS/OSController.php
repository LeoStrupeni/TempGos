<?php
namespace App\Http\Controllers\Gos\OS;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use Illuminate\Support\Facades\Storage;
use App\Gos\Gos_OS;
use App\Gos\Gos_OS_Anticipo;
use App\Gos\Gos_OS_Tipo_O;
use App\Gos\Gos_OS_Tipo_Danio;
use App\Gos\Gos_OS_Estado_Exp;
use App\Gos\Gos_OS_Riesgo;
use App\Gos\Gos_V_Clientes_Vehiculos;
use App\Gos\Gos_V_Aseguradoras_;
use App\Gos\Gos_Ot;
use App\Gos\Gos_Metodo_Pago;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_Paquete;
use App\Gos\Gos_Producto;
use App\Gos\Gos_V_Os;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Medidor_Gas;
use App\GosClases\OS;
use Prophecy\Argument\Token\ObjectStateToken;
use GosClases\ItemsOS;
use App\Gos\Gos_Vehiculo_Inventario;
use App\Gos\Gos_V_Inventario_Vehiculo;
use App\Gos\Gos_V_Inventario_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Tipo;
use App\Gos\Gos_Cliente;
use App\Gos\Gos_Vehiculo;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_V_Inicio_Calendario;
use App\Gos\Gos_Paq_Etapa;
use App\Gos\Gos_Paquete_Item;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_Os_Ligadas;
use App\Gos\Gos_Ase_OS;
use App\Gos\Gos_Os_Encuesta;
use Session;
use App\Gos\Gos_V_Equipo_Trabajo;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use App\Gos\Gos_Pres;
use Illuminate\Support\Collection;
/**
 *
 * @author yois
 *
 */
class OSController extends GosControllers
{

    protected $vistaListado = 'OS/ListarOrdenDeServiciopagin';

    protected $opcionesEditDataTable = 'OS.OpcionesDataTable';

    /**
     * Muestra lista de ordes de servicios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $idtaller=Session::get('taller_id');
        $osobj = Gos_V_Os_Generada::get();
        $listaOS = self::listadoGeneral();
        $OSProceso = DB::select( DB::raw('SELECT *, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
        CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
	                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa
        FROM gos_v_inicio_calendario gvic
        LEFT JOIN (SELECT  SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+ SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id 
        FROM gos_os_item
        GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id
        LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
         WHERE  gos_taller_id='.$idtaller.' AND fecha_terminado IS NULL AND fecha_historico IS NULL AND fecha_cancelado IS NULL
         GROUP BY gvic.gos_os_id
         ORDER BY nro_orden_interno+000000 DESC'));
        $ajax = $this->preparaDataTableAjax($OSProceso, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        
        $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
        $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $name=('Órdenes En Proceso');
        $activePro=('active');
        $os = $OSProceso;
        $osLigadas=Gos_Os_Ligadas::all();
        $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activePro','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
        return view($this->getVistaListado(),$compact);
    }


    /**
     * Muestra formulario de Editar/Crear Orden de Servicio.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compact = $this->preparaCrearEditar();
        return view('/OS/EditarOrden', $compact);
    }

    /**
     *
     * @param string $criterio
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
         $idtaller=Session::get('taller_id');
        $sel='SELECT CONCAT(@row_number:=@row_number+1 , "|", d.gos_os_id) AS row_number ,d.* FROM gos_v_inicio_calendario as d,(SELECT @row_number:=0) AS t  where gos_taller_id='.$idtaller;

        // return Gos_V_Inicio_Calendario::select('ROW_NUMBER() OVER(ORDER BY gos_taller_id DESC) AS Row, *')->where(self::condIdTaller())->whereNull('fecha_pago')->get();
        return DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario
         WHERE  gos_taller_id='.$idtaller.' AND fecha_terminado IS NULL
         GROUP BY gos_os_id
         ORDER BY nro_orden_interno+000000 DESC'));
    }

    /**
     * Prepara informacion antes de editr orden de servicio
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $os = null;
        $selectsVehiculo = $this->obtenSelectsVehiculo();
        $gloables = parent::preparaCrearEditar();
        $selectsOS = $this->obtenSelectsOS();
        $gloables = array_merge($gloables, $selectsOS,  $selectsVehiculo);
        return $gloables;
    }

    /**
     *
     * @return array
     */
    protected function obtenSelectsOS()
    {
        // lista para selects
        $condIdTaller = self::condIdTaller();
        $listaAseguradoras = Gos_V_Aseguradoras_::where($condIdTaller)->get();
        $listaTot = Gos_Ot::where($condIdTaller)->get();
        $listaTipoOrden = Gos_OS_Tipo_O::all();
        $listaDanios = Gos_OS_Tipo_Danio::all();
        $listaEstadosExp = Gos_OS_Estado_Exp::all();
        $listaRiesgos = Gos_OS_Riesgo::all();
        $listaMetodos = Gos_Metodo_Pago::all();
        // Listas Inventario
        $listaInteriores = Gos_Vehiculo_Parte::where('tipo', 'Interiores')->get();
        $listaExteriores = Gos_Vehiculo_Parte::where('tipo', 'Exteriores')->get();
        $listaMotores = Gos_Vehiculo_Parte::where('tipo', 'Motor')->get();
        $listaCajuela = Gos_Vehiculo_Parte::where('tipo', 'Cajuela')->get();
        $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
        $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
        // Lista para Items
        $listaEtapas = Gos_V_Paq_Etapas::where('gos_taller_id',Session::get('taller_id'))->get();
        $listaServicios = Gos_V_Paq_Servicios::where('gos_taller_id',Session::get('taller_id'))->get();
        $listaPaquetes = Gos_Paquete::where('gos_taller_id',Session::get('taller_id'))->get();
        $listaProductos = Gos_Producto::where('gos_taller_id',Session::get('taller_id'))->get();
        $idtaller=Session::get('taller_id');
        $listadoAsesores = Gos_V_Equipo_Trabajo::where('gos_taller_id', $idtaller)->where('gos_usuario_rol_id', 1)->get();
        $aseguradora = null;
        $tot = null;
        $riesgo = null;
        $danio = null;
        $orden = null;
        $estado = null;
        $usuario_id = Session::get('usr_Data');

        $usuario = $usuario_id['gos_usuario_id'];
        $inventario= new Gos_Vehiculo_Inventario();
        return compact('usuario','listaAseguradoras','listadoAsesores', 'listaTot', 'listaTipoOrden', 'listaDanios', 'listaEstadosExp', 'listaRiesgos', 'listaMetodos','listaInteriores','listaExteriores','listaMotores','listaCajuela','listaMedidorGas','listaTipoVehiculo','listaEtapas', 'listaServicios', 'listaPaquetes','listaProductos', 'aseguradora','tot','riesgo','danio','orden','estado','inventario');
    }

    /**
     * Devuelve resultado de busqueda de clientes vehiculo
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function encuentra(Request $request)
    {
        $fraseBuscar = $request->get('buscar');
        /**
         * *
         * where('email', Input::get('email'))
         * ->orWhere('name', 'like', '%' .
         * Input::get('name') . '%')->get();
         */
        /**
         *
         * @var array $campos_a_buscar
         */
        $campos_a_buscar = array(
            'nomb_vehiculo',
            'LIKE',
            "'%$fraseBuscar%'"
        );
        $listaClientesVehiculos = Gos_V_Clientes_Vehiculo::where('gos_taller_id',Session::get('taller_id'))->get();

        return view('OS/EditarDesglose/ModalElegirClienteVehiculos', compact('listaClientesVehiculos'));
    }

    /**
     * Devuelve resultado de busqueda de clientes vehiculo
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function enviaWhatsApp(Request $request)
    {
        // /respose redirect al link de whatsapp
    /**
     * gos_cliente_id
     * tomar del request el nro de telefono del cliente
     * tomar del request el nombre del cliente
     * redirect a whatssap
     */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function clienteVehiculoStore(Request $request)
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
        $os = $this->preparaDatos($request);
        return Response::json($os);
    }

    /**
     *
     * @param unknown $request
     * @return \App\Gos\Gos_OS
     */
    protected function preparaDatos($request)
    {
        $os = null;
        $gos_os_id = isset($request->gos_os_id) ? $request->gos_os_id : 0;
        //
        $datos = $this->datosEntidad($request);
        // dd($generales);
        if ($gos_os_id > 0) {
            $os = Gos_OS::find($gos_os_id)->update($datos);
        } else {
            $os = new Gos_OS($datos);
            $os->save();
            $gos_os_id = $os->gos_os_id;
        }
        //


        $this->setEntidad_id($gos_os_id);
          $osTKN = Gos_OS::find($gos_os_id);
          if($osTKN->gos_os_token_seguimiento==Null){
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $randomString = '';
           for ($i = 0; $i < 10; $i++) {
               $index = rand(0, strlen($characters) - 1);
               $randomString .= $characters[$index];
              }
             $osTKN->gos_os_token_seguimiento=$randomString;
             $osTKN->gos_os_liga_seguimiento='//LigaSeguimiento/'.$randomString;
             $osTKN->save();


            }
        return $os;
    }

    /**
     *
     * @param unknown $request
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        // preparar variables
        $ahora = $this->ahoraFormatoMySQL();
        // dd($ahora);
        $fecha_creacion_os = isset($request->fecha_creacion_os) ? $request->fecha_creacion_os : $ahora;
        $fecha_creacion_os = date("Y-m-d h:i:s", strtotime($fecha_creacion_os));
        if($request->gos_os_estado_exp_id== 2){
            $fecha_ingreso_v_os = 0;
        }
        else{
            $fecha_ingreso_v_os = isset($request->fecha_ingreso_v_os) ? $request->fecha_ingreso_v_os : $ahora;
        }
        if(isset($request->fecha_promesa)){

            $fecha_promesa_os = date("Y-m-d h:i:s", strtotime($request->fecha_promesa));
        }
        else{

            $fecha_promesa_os = isset($request->fecha_promesa) ? $request->fecha_promesa : 0;
        }
        $tallerIdActual = self::tallerIdActual();
        $gos_ot_id = isset($request->gos_ot_id) ? $request->gos_ot_id : 0;
        $subtotal = isset($request->subtotal) ? $request->subtotal : 0;
        //
        return [
            'gos_cliente_id' => $request->gos_cliente_id,
            'gos_taller_id' => $tallerIdActual,
            'gos_aseguradora_id' => $request->gos_aseguradora_id,
            'gos_ot_id' =>  $gos_ot_id,
            'nro_poliza' => $request->nro_poliza,
            'nro_siniestro' => $request->nro_siniestro,
            'gos_os_riesgo_id' => $request->gos_os_riesgo_id,
            'nro_reporte' => $request->nro_reporte,
            'nro_orden' => $request->nro_orden,
            'gos_os_tipo_o_id' => $request->gos_os_tipo_o_id,
            'gos_os_tipo_danio_id' => $request->gos_os_tipo_danio_id,
            'gos_os_estado_exp_id' => $request->gos_os_estado_exp_id,
            'gos_vehiculo_id' => $request->gos_vehiculo_id,
            'demerito' => $request->demerito,
            'deducible' => $request->deducible,
            'descuento_tipo' => $request->descuento_tipo,
            'subtotal' => $subtotal,
            'iva' => $request->iva,
            'fecha_creacion_os' => $fecha_creacion_os,
            'fecha_ingreso_v_os' => $fecha_ingreso_v_os,
            'fecha_promesa_os' => $fecha_promesa_os,
            'gos_usuario_id' => $request->gos_usuario_id
        ];
    }

    /**
     * devuelve la fecha y hora de creacion de OS
     *
     * @param integer $gos_os_id
     * @return \DateTime
     */
    public static function fecha_creacion_os($gos_os_id)
    {
        return Gos_OS::where('gos_os_id', $gos_os_id)->pluck('fecha_creacion_os');
    }

    /**
     * devuelve la fecha y hora de ingreso del vehiculo de la OS
     *
     * @param integer $gos_os_id
     * @return \DateTime
     */
    public static function fecha_ingreso_v_os($gos_os_id)
    {
        return Gos_OS::find($gos_os_id)->pluck('fecha_ingreso_v_os');
    }

    /**
     * devuelve la fecha y hora de promesa de OS
     *
     * @param integer $gos_os_id
     * @return \DateTime
     */
    public static function fecha_promesa_os($gos_os_id)
    {
        return Gos_OS::find($gos_os_id)->pluck('fecha_promesa_os');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idtaller=Session::get('taller_id');
        $OSProceso = DB::select(DB::raw('SELECT nro_orden_interno,gos_os_id,nomb_cliente,detallesVehiculo
        FROM gos_v_inicio_calendario
        WHERE gos_taller_id='.$idtaller.' AND gos_os_id='.$id.' AND fecha_terminado IS NULL
        GROUP BY gos_os_id
        ORDER BY nro_orden_interno+000000 DESC'));

        $opciones = 'Compras.OpcionesUnirCompra';

        $ajax = $this->preparaDataTableAjax($OSProceso,$opciones);
        return $ajax;

    }



    // protected function preparaInventarioVehiculo($gos_os_id)
    // {
    //     $listaInventario = Gos_V_Inventario_Vehiculo::where('gos_os_id',$gos_os_id)->get();
    //     $listaInteriores = Gos_V_Inventario_Vehiculo_Parte::where([['gos_os_id', '=', $gos_os_id],['tipo', '=', 'Interiores'],])->get();
    //     $listaExteriores = Gos_V_Inventario_Vehiculo_Parte::where([['gos_os_id', '=', $gos_os_id],['tipo', '=', 'Exteriores'],])->get();
    //     $listaMotores = Gos_V_Inventario_Vehiculo_Parte::where([['gos_os_id', '=', $gos_os_id],['tipo', '=', 'Motor'],])->get();
    //     $listaCajuela = Gos_V_Inventario_Vehiculo_Parte::where([['gos_os_id', '=', $gos_os_id],['tipo', '=', 'Cajuela'],])->get();
    //     $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
    //     $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();

    //     return compact('listaInventario','listaInteriores', 'listaExteriores', 'listaMotores', 'listaCajuela', 'listaMedidorGas', 'listaTipoVehiculo');
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_os_id)
    {

        $os = Gos_V_Os::find($gos_os_id);
        $usuario_id = Session::get('usr_Data');
        $anticipo = Gos_Os_Anticipo::where('gos_os_id',$gos_os_id)->count();
        $checkAnticipo = ($anticipo>0) ? "si" : "no";
        $usuario = $usuario_id['gos_usuario_id'];
        $listaInteriores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Interiores'],['gos_os_id', $gos_os_id]])->get();
        $listaExteriores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Exteriores'],['gos_os_id', $gos_os_id]])->get();
        $listaMotores = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Motor'],['gos_os_id', $gos_os_id]])->get();
        $listaCajuela = Gos_V_Inventario_Vehiculo_Parte::where([['tipo', 'Cajuela'],['gos_os_id', $gos_os_id]])->get();
        $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
        $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
        $inventario = Gos_V_Inventario_Vehiculo::where('gos_os_id', $gos_os_id)->first();
        $usuario_id = Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario_id->gos_taller_id)->first();


        $datosOS = array();
        // traer items de orden de servicio
        $generales = $this->preparaCrearEditar();
        //
        $aseguradora = ($gos_os_id > 0) ? $os->gos_aseguradora_id : 0;
        $tot = ($gos_os_id > 0) ? $os->gos_ot_id : 0;
        $riesgo = ($gos_os_id > 0) ? $os->gos_os_riesgo_id : 0;
        $danio = ($gos_os_id > 0) ? $os->gos_os_tipo_danio_id : 0;
        $orden = ($gos_os_id > 0) ? $os->gos_os_tipo_o_id : 0;
        $estado = ($gos_os_id > 0) ? $os->gos_os_estado_exp_id : 0;
        $datosOS = compact('checkAnticipo','os','usuario', 'inventario' ,'listaInteriores', 'listaExteriores', 'listaMotores', 'listaCajuela', 'listaMedidorGas', 'listaTipoVehiculo','aseguradora','tot','riesgo', 'danio','orden','estado','taller_conf_vehiculo','taller_conf_ase');

        $compact = array_merge($generales, $datosOS);
        return view('/OS/EditarOrden', $compact);
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
    public function destroy($gos_os_id)
    {
        $os = Gos_Os::find($gos_os_id);
        $os->delete();
        return Response::json($os);
    }

    /**
     *
     * @param Request $request
     */
    public function guardaOrdenServicio(Request $request)
    {
    /**
     * guardar la orden de servicio
     */
    }

    /**
     * Guardar item de orden de servicio
     *
     * @param Request $request
     */
    public function guardaItemOrdenServicio(Request $request)
    {
    /**
     * guardar orden de servicio y refrescar items/pagina
     */
    }

    /**
     * deveulve informacion de item de Etapa seleccionado desde orden de servicio
     *
     * @param unknown $request
     */
    public function traeDatosItemEtapa(Request $request)
    {
        //
    }

    /**
     * deveulve informacion de item de Paquete seleccionado desde orden de servicio
     *
     * @param Request $request
     */
    public function traeDatosItemPaquete(Request $request)
    {
        //
    }

    /**
     * deveulve informacion de item de producto seleccionado desde orden de servicio
     *
     * @param Request $request
     */
    public function traeDatosItemProducto(Request $request)
    {
        //
    }

    /**
     * guarda datos del anticipo
     *
     * @param Request $request
     */
    public function guardaAnticipo(Request $request)
    {
        //
    }

    /**
     * Devuelve lista de Clientes/Vehiculos para seleccionar en orden de Servicio
     *
     * @param Request $request
     * @return string
     */
    public function listaClientesVehiculos(Request $request)
    {
        $clientesVehiculos = Gos_V_Clientes_Vehiculos::where('gos_taller_id',Session::get('taller_id'))->get();
        // all()->where(self::condIdTaller());
        return $this->preparaDatosDataTable($clientesVehiculos, 1);
    }

    /**
     * Guardar los datos del inventario
     *
     * @param Request $request
     */
    public function guardaInventarioVehiculo(Request $request)
    {
        return '{}';
    }

    /**
     *
     * @param Request $request
     */
    public function muestraInventarioVehiculo()
    {
        return '{}';
    }
    public function insertaClienteVehiculo(Request $request)
    {

        $idtaller=Session::get('taller_id');
        $repetido = Gos_Cliente::where('nombre',$request->nombre)->where('apellidos',$request->apellidos)->where('gos_taller_id', $idtaller)->first();
        if($repetido == null){
            $cliente = new Gos_Cliente();
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->celular = $request->celular;
            $cliente->empresa = $request->empresa;
            $cliente->gos_taller_id = Session::get('taller_id');
            $cliente->email_cliente = $request->email_cliente;
            $cliente->save();

            $gos_cliente_id = $cliente->gos_cliente_id;
            $vehiculo = new Gos_Vehiculo();
            $vehiculo->gos_cliente_id =  $gos_cliente_id;
            $vehiculo->gos_vehiculo_modelo_id =  $request->gos_vehiculo_modelo_id;
            $vehiculo->anio_vehiculo = $request->anio_vehiculo;
            $vehiculo->color_vehiculo = $request->color_vehiculo;
            $vehiculo->placa = $request->placa;
            $vehiculo->economico = $request->economico;
            $vehiculo->nro_serie = $request->nro_serie;
            $vehiculo->save();
            $gos_vehiculo_id = $vehiculo->gos_vehiculo_id;

            return ["gos_cliente_id"=>$gos_cliente_id, "gos_vehiculo_id"=>$gos_vehiculo_id];
        }
        else {
            return '';
        }


    }
    public function actualizaFechaIngresoOS(Request $request)
    {
        
        $fechaingreso = date("Y-m-d h:i:s",strtotime($request->fecha_entrega));
        $gos_os_id = $request->gos_os_id;
        $pres = Gos_Pres::where('gos_pres_os_id',$gos_os_id)->first();
        $gos = Gos_OS::find($gos_os_id);
         if ($gos) {
             $gos->fecha_ingreso_v_os = $fechaingreso;
             $gos->gos_os_estado_exp_id = 1;
          //--------------------------------------------------------------------------------------------------------------------------------------------

             if($pres!=null){
                if($pres->gos_pres_estatus==1){
                
                    $valuacionpres=$pres->valuacion;
                   
                    if($valuacionpres!=null){
                        $tipoval = explode("V", $valuacionpres);
                        
                        $date = strtotime($fechaingreso);
                        $day = date('l', $date);

                              if($tipoval[1]==0){
                                if($day=='Monday'){$diasval = date("Y-m-d H:i:s", strtotime($fechaingreso));}
                                if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 1 days'));}
                                if($day=='Sunday'){$diasval = date("Y-m-d H:i:s", strtotime($fechaingreso));}
                                $gos->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 4 days'));//4
                              }
                              if($tipoval[1]==1){
                                if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                                if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                                if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 3 days'));}
                                if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 2 days'));}
                                $gos->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 7 days'));//7
                              }
                              if($tipoval[1]==2){
                                if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                                if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                                if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                                if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                                if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 6 days'));}
                                if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 5 days'));}
                                if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 4 days'));}
                                $gos->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 14 days'));//14
                              }
                              if($tipoval[1]==3){
                                if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                                if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                                if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                                if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                                if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 12 days'));}
                                if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 11 days'));}
                                if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 10 days'));}
                                $gos->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 28 days'));//28
                              }
                              if($tipoval[1]==4){
                                if($day=='Monday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                                if($day=='Tuesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                                if($day=='Wednesday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                                if($day=='Thursday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                                if($day=='Friday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 18 days'));}
                                if($day=='Saturday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 17 days'));}
                                if($day=='Sunday'){ $diasval = date("Y-m-d H:i:s", strtotime($fechaingreso. ' + 16 days'));}
                                $gos->fecha_promesa_os=date("Y-m-d H:i:s", strtotime($diasval. ' + 45 days'));//45
                              }
                            //   return($gos->fecha_promesa_os);
                    }
                }
             }
          //--------------------------------------------------------------------------------------------------------------------------------------------
             $gos->save();
         }

        return $fechaingreso;
    }
    public function clientesOS($gos_cliente_id){
        $listaOS = Gos_V_Os::where('gos_cliente_id', $gos_cliente_id)->get();
        $ajax = $this->preparaDataTableAjax($listaOS, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
    }

    public function paginacion(Request $request){
        $idtaller=Session::get('taller_id');
           //-------------------------------contadores-------------------------------------------------------------------------//
           $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
           $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
           $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
           $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
           ->where(function($query){
               $query->where('fecha_facturado','!=',NULL)
                   ->orwhere('fecha_historico','!=',NULL)
                       ->orwhere('fecha_cancelado','==',NULL);
           })
           ->count();
           $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
           //-------------------------------contadores-------------------------------------------------------------------------//
        //-------------------------------OSPROCESO-------------------------------------------------------------------------//
            $queryenc = DB::table('gos_os_encuesta')
            ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
            $queryprecio = DB::table('gos_os_item')
            ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
            SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
            ->groupBy('gos_os_id');
            $osprosceso = DB::table('gos_v_inicio_calendario as gvic')
            ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                $join->on('gos_total.id', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc, 'goe', function ($join) {
                $join->on('goe.id2', '=', 'gvic.gos_os_id');
            })
            ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
            ->where('gvic.gos_taller_id',$idtaller)
            ->whereNull('fecha_terminado')
            ->whereNull('fecha_historico')
            ->whereNull('fecha_cancelado')
            ->groupBy('gos_os_id')
            ->orderBy('gos_os_id','desc')
            ->paginate(50);
            $turco = $osprosceso->render();
            $conteoProc = $osprosceso->count();
            $totalProc = $osprosceso->total();
        //-------------------------------OSTERMINADA-------------------------------------------------------------------------//
            $queryenc1 = DB::table('gos_encuesta')
            ->select( 'gos_encuesta_id','nombre_encuesta', 'gos_aseguradora_id as asgid');
            $osterminada = DB::table('gos_v_inicio_calendario as gvic')
            ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                $join->on('gos_total.id', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc, 'goe', function ($join) {
                $join->on('goe.id2', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc1, 'ge', function ($join) {
                $join->on('ge.asgid', '=', 'gvic.gos_aseguradora_id');//as ge ON  ge.asgid =  gvic.gos_aseguradora_id
            })
            ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
            ->where('gvic.gos_taller_id',$idtaller)
            ->whereNotNull('fecha_terminado')
            ->whereNull('fecha_historico')
            ->whereNull('fecha_entregado')
            ->whereNull('fecha_cancelado')
            ->groupBy('gos_os_id')
            ->orderBy('gos_os_id','desc')
            ->paginate(50);
            $pagter = $osterminada->render();
        //-------------------------------OSENTREGADAS-------------------------------------------------------------------------// 
            $osentregadas = DB::table('gos_v_inicio_calendario as gvic')
            ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                $join->on('gos_total.id', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc, 'goe', function ($join) {
                $join->on('goe.id2', '=', 'gvic.gos_os_id');
            })
            ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
            ->where('gvic.gos_taller_id',$idtaller)
            ->whereNotNull('fecha_terminado')
            ->whereNotNull('fecha_entregado')
            ->whereNull('fecha_facturado')
            ->whereNull('fecha_historico')
            ->whereNull('fecha_cancelado')
            ->groupBy('gos_os_id')
            ->orderBy('gos_os_id','desc')
            ->paginate(50);
            $pagentr = $osprosceso->render();
        //-------------------------------OSHISTORICO-------------------------------------------------------------------------//
            $oshistorico = DB::table('gos_v_inicio_calendario as gvic')
            ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                $join->on('gos_total.id', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc, 'goe', function ($join) {
                $join->on('goe.id2', '=', 'gvic.gos_os_id');
            })
            ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
            ->where('gvic.gos_taller_id',$idtaller)
            ->where(function ($query) {
                $query->whereNotNull('fecha_facturado')
                      ->orWhereNotNull('fecha_historico');
            })
            ->groupBy('gos_os_id')
            ->orderBy('gos_os_id','desc')
            ->paginate(50);
            $paghist = $oshistorico->render();
        //-------------------------------OSCANCELADAS-------------------------------------------------------------------------//
            $oscaceladas = DB::table('gos_v_inicio_calendario as gvic')
            ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                $join->on('gos_total.id', '=', 'gvic.gos_os_id');
            })
            ->leftjoinSub($queryenc, 'goe', function ($join) {
                $join->on('goe.id2', '=', 'gvic.gos_os_id');
            })
            ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
            ->where('gvic.gos_taller_id',$idtaller)
            ->whereNotNull('fecha_cancelado')
            ->whereNull('fecha_historico')
            ->groupBy('gos_os_id')
            ->orderBy('gos_os_id','desc')
            ->paginate(50);
            $pagcanc = $oscaceladas->render();

        //-------------------------------OSFILTRO-------------------------------------------------------------------------//
            if(isset($request->filtrobuscadorOS)){
                if(isset($request->buscadorOS)){
                    $filtro = $request->filtrobuscadorOS;
                    $search = $request->buscadorOS;
                    $querygen = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->where(function($filter) use ($filtro, $search){
                        if($filtro=='#Orden'){
                            $filter->where('nro_orden_interno', $search);

                        }

                        elseif ($filtro=='Fecha' ) {

                            $filter->where('fecha_creacion', 'like', '%'.$search.'%');
                        }
                        elseif ($filtro=='Cliente' ) {

                            $filter->where('nomb_cliente', 'like', '%'.$search.'%');
                        }
                        elseif ($filtro=='Aseguradora' ) {

                            $filter->where('nomb_aseguradora', 'like', '%'.$search.'%');
                        }
                        elseif ($filtro=='Vehiculo' ) {

                            $filter->where('detallesVehiculo', 'like', '%'.$search.'%');
                        }
                        else{

                            $filter->where('asesor', 'like', '%'.$search.'%');
                        }
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->get();
                 //-------------------------------OSFILTRO   #ID-------------------------------------------------------------------------//
                    $conteo = $querygen->count();
                    if($filtro=='#Orden'){

                        if(isset($querygen[0])){

                       
                        
                            $querygen = $querygen[0]; 
                            $fechater = $querygen->fecha_terminado;
                            $fechahist = $querygen->fecha_historico;
                            $fechacancel = $querygen->fecha_cancelado;
                            $fechaentr = $querygen->fecha_entregado;
                            $fechafact = $querygen->fecha_facturado;
                            $activpro = "";
                            $activter = "";
                            $activent = "";
                            $activhis = "";
                            $activcan = "";
                            if($fechater==null && $fechahist==null && $fechacancel==null){
                                $osprosceso = DB::table('gos_v_inicio_calendario as gvic')
                                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc, 'goe', function ($join) {
                                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                                })
                                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                                ->where('gvic.gos_taller_id',$idtaller)
                                ->where('gvic.nro_orden_interno',$search)
                                ->groupBy('gos_os_id')
                                ->orderBy('gos_os_id','desc')
                                ->get();
                                $cuentaProces = $osprosceso->count();
                                $activpro = "active";
                                // return('en proceso');
                            }
                            elseif($fechahist==null && $fechaentr==null && $fechacancel==null && $fechater!=null){
                                $osterminada = DB::table('gos_v_inicio_calendario as gvic')
                                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc, 'goe', function ($join) {
                                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc1, 'ge', function ($join) {
                                    $join->on('ge.asgid', '=', 'gvic.gos_aseguradora_id');//as ge ON  ge.asgid =  gvic.gos_aseguradora_id
                                })
                                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                                ->where('gvic.gos_taller_id',$idtaller)
                                ->where('gvic.nro_orden_interno',$search)
                                ->groupBy('gos_os_id')
                                ->orderBy('gos_os_id','desc')
                                ->get();
                        
                                $cuentaTerminadas = $osterminada->count();
                                $activter = "active";
                            }
                            elseif($fechafact==null  && $fechahist==null && $fechacancel==null && $fechater!=null && $fechaentr!=null){
                                $osentregadas = DB::table('gos_v_inicio_calendario as gvic')
                                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc, 'goe', function ($join) {
                                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                                })
                                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                                ->where('gvic.gos_taller_id',$idtaller)
                                ->where('gvic.nro_orden_interno',$search)
                                ->groupBy('gos_os_id')
                                ->orderBy('gos_os_id','desc')
                                ->get();
                        
                                $cuentaEntregadas = $osentregadas->count();
                                $activent = "active";
                                // return('en entregada');
                            }
                            elseif($fechahist==null && $fechacancel!=null){
                                $oscaceladas = DB::table('gos_v_inicio_calendario as gvic')
                                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc, 'goe', function ($join) {
                                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                                })
                                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                                ->where('gvic.gos_taller_id',$idtaller)
                                ->where('gvic.nro_orden_interno',$search)
                                ->groupBy('gos_os_id')
                                ->orderBy('gos_os_id','desc')
                                ->get();
                        
                                $cuentaCanceladas = $oscaceladas->count();
                                $activcan = "active";
                                // return('en cancelada');
                            }
                            else{
                                $oshistorico = DB::table('gos_v_inicio_calendario as gvic')
                                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                                })
                                ->leftjoinSub($queryenc, 'goe', function ($join) {
                                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                                })
                                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots'))
                                ->where('gvic.gos_taller_id',$idtaller)
                                ->where('gvic.nro_orden_interno',$search)
                                ->groupBy('gos_os_id')
                                ->orderBy('gos_os_id','desc')
                                ->get();
                        
                                $cuentahistorico = $oshistorico->count();
                                $activhis = "active";
                                // return('en historico');
                            }
                        }
                        else{return back()->with('alert', 'La órden que buscas no existe, prueba con otro número.');}
                 //-------------------------------OSFILTRO   #ID-------------------------------------------------------------------------//
                    }
                    else{
                        $osprosceso = $querygen;
                    }
                }
            }
     

        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $osLigadas=Gos_Os_Ligadas::all();
        if (isset($filtro))
        {
           if(isset($activpro)){
            $compact = compact('osprosceso','pagter','osterminada','pagentr','osentregadas','paghist','oshistorico','pagcanc','oscaceladas',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase'
            ,'filtro','search','conteo','activpro','activter','activent','activhis','activcan');
           }
            else{
            $compact = compact('osprosceso','pagter','osterminada','pagentr','osentregadas','paghist','oshistorico','pagcanc','oscaceladas',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase'
            ,'filtro','search','conteo');
            }
        }
        else{
            $compact = compact('turco','osprosceso','conteoProc','totalProc','pagter','osterminada','pagentr','osentregadas','paghist','oshistorico','pagcanc','oscaceladas',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
        }
       
        return view('OS\pruebasOSlistado/pruebapaginacion',$compact);
    }

    //Proceso
        public function verospro(){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------OSPROCESO-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $osprosceso = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNull('fecha_terminado')
                ->whereNull('fecha_historico')
                ->whereNull('fecha_cancelado')
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
                $turco = $osprosceso->render();
                $conteoProc = $osprosceso->count();
                $totalProc = $osprosceso->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('turco','osprosceso','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarProceso',$compact);
        }

        public function resospro(Request $request){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------OSPROCESO-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
            if($request->buscadorOS!=null){
                $search = $request->buscadorOS;
                
                $osprosceso = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNull('fecha_terminado')
                ->whereNull('fecha_historico')
                ->whereNull('fecha_cancelado')
                ->where(function($filter) use ($search){
                        $filter->where('nro_orden_interno', 'like', '%'.$search.'%');

                        $filter->orWhere('fecha_creacion', 'like', '%'.$search.'%');

                        $filter->orWhere('nomb_cliente', 'like', '%'.$search.'%');

                        $filter->orWhere('nomb_aseguradora', 'like', '%'.$search.'%');

                        $filter->orWhere('detallesVehiculo', 'like', '%'.$search.'%');

                        $filter->orWhere('asesor', 'like', '%'.$search.'%');
                })
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
            }
            else {
                $osprosceso = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNull('fecha_terminado')
                ->whereNull('fecha_historico')
                ->whereNull('fecha_cancelado')
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
            }
                $cuentaProces = $osprosceso->count();
                $turco = $osprosceso->render();
                $conteoProc = $cuentaProces;
                $totalProc = $osprosceso->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('turco','osprosceso','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarProceso',$compact);
        }
    //terminada

        public function veroster(){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------OSTERMINADA-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $queryenc1 = DB::table('gos_encuesta')
                ->select( 'gos_encuesta_id','nombre_encuesta', 'gos_aseguradora_id as asgid');
                $osterminada = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc1, 'ge', function ($join) {
                    $join->on('ge.asgid', '=', 'gvic.gos_aseguradora_id');//as ge ON  ge.asgid =  gvic.gos_aseguradora_id
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNotNull('fecha_terminado')
                ->whereNull('fecha_historico')
                ->whereNull('fecha_entregado')
                ->whereNull('fecha_cancelado')
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
                $pagter = $osterminada->render();
                $conteoProc = $osterminada->count();
                $totalProc = $osterminada->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('pagter','osterminada','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarTerminadas',$compact);
        }

        public function resoster(Request $request){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------OSTERMINADA-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $queryenc1 = DB::table('gos_encuesta')
                ->select( 'gos_encuesta_id','nombre_encuesta', 'gos_aseguradora_id as asgid');
                if($request->buscadorOS!=null){
                    $search = $request->buscadorOS;
                    
                    $osterminada = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc1, 'ge', function ($join) {
                        $join->on('ge.asgid', '=', 'gvic.gos_aseguradora_id');//as ge ON  ge.asgid =  gvic.gos_aseguradora_id
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_terminado')
                    ->whereNull('fecha_historico')
                    ->whereNull('fecha_entregado')
                    ->whereNull('fecha_cancelado')
                    ->where(function($filter) use ($search){
                            $filter->where('nro_orden_interno', 'like', '%'.$search.'%');

                            $filter->orWhere('fecha_creacion', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_cliente', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_aseguradora', 'like', '%'.$search.'%');

                            $filter->orWhere('detallesVehiculo', 'like', '%'.$search.'%');

                            $filter->orWhere('asesor', 'like', '%'.$search.'%');
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                else {
                    $osterminada = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc1, 'ge', function ($join) {
                        $join->on('ge.asgid', '=', 'gvic.gos_aseguradora_id');//as ge ON  ge.asgid =  gvic.gos_aseguradora_id
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_terminado')
                    ->whereNull('fecha_historico')
                    ->whereNull('fecha_entregado')
                    ->whereNull('fecha_cancelado')
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                $cuentaTerminadas = $osterminada->count();
                $pagter = $osterminada->render();
                $conteoProc = $osterminada->count();
                $totalProc = $osterminada->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
            $compact = compact('pagter','osterminada','conteoProc','totalProc',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarTerminadas',$compact);
        }
     //entregada

        public function verosent(){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------entregada-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $osentregadas = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNotNull('fecha_terminado')
                ->whereNotNull('fecha_entregado')
                ->whereNull('fecha_facturado')
                ->whereNull('fecha_historico')
                ->whereNull('fecha_cancelado')
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
                $pagentr = $osentregadas->render();
                $conteoProc = $osentregadas->count();
                $totalProc = $osentregadas->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('pagentr','osentregadas','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarEntregadas',$compact);
        }

        public function resosent(Request $request){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------entregada-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                if($request->buscadorOS!=null){
                    $search = $request->buscadorOS;
                    
                    $osentregadas = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_terminado')
                    ->whereNotNull('fecha_entregado')
                    ->whereNull('fecha_facturado')
                    ->whereNull('fecha_historico')
                    ->whereNull('fecha_cancelado')
                    ->where(function($filter) use ($search){
                            $filter->where('nro_orden_interno', 'like', '%'.$search.'%');

                            $filter->orWhere('fecha_creacion', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_cliente', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_aseguradora', 'like', '%'.$search.'%');

                            $filter->orWhere('detallesVehiculo', 'like', '%'.$search.'%');

                            $filter->orWhere('asesor', 'like', '%'.$search.'%');
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                else {
                    $osentregadas = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_terminado')
                    ->whereNotNull('fecha_entregado')
                    ->whereNull('fecha_facturado')
                    ->whereNull('fecha_historico')
                    ->whereNull('fecha_cancelado')
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                $cuentaEntregadas = $osentregadas->count();

                $pagentr = $osentregadas->render();
                $conteoProc = $cuentaEntregadas;
                $totalProc = $osentregadas->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
            $compact = compact('pagentr','osentregadas','conteoProc','totalProc',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
                
            return view('OS/pruebasOSlistado/ListarEntregadas',$compact);
        }

    //historico

        public function veroshis(){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------ListarHistorico-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $oshistorico = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->where(function ($query) {
                    $query->whereNotNull('fecha_facturado')
                        ->orWhereNotNull('fecha_historico');
                })
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
                $paghist = $oshistorico->render();
                $conteoProc = $oshistorico->count();
                $totalProc = $oshistorico->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('paghist','oshistorico','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarHistorico',$compact);
        }

        public function resoshis(Request $request){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------ListarHistorico-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                if($request->buscadorOS!=null){
                    $search = $request->buscadorOS;
                    
                    $oshistorico = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                        CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                        WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                        WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                        ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->where(function ($query) {
                        $query->whereNotNull('fecha_facturado')
                            ->orWhereNotNull('fecha_historico');
                    })
                    ->where(function($filter) use ($search){
                            $filter->where('nro_orden_interno', 'like', '%'.$search.'%');

                            $filter->orWhere('fecha_creacion', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_cliente', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_aseguradora', 'like', '%'.$search.'%');

                            $filter->orWhere('detallesVehiculo', 'like', '%'.$search.'%');

                            $filter->orWhere('asesor', 'like', '%'.$search.'%');
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                else {
                    $oshistorico = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                        CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                        WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                        WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                        ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->where(function ($query) {
                        $query->whereNotNull('fecha_facturado')
                            ->orWhereNotNull('fecha_historico');
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                $cuentahistorico = $oshistorico->count();

                $paghist = $oshistorico->render();
                $conteoProc = $cuentahistorico;
                $totalProc = $oshistorico->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
            $compact = compact('paghist','oshistorico','conteoProc','totalProc',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
                
            return view('OS/pruebasOSlistado/ListarHistorico',$compact);
        }

    //cancelada

        public function veroscan(){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------listarcanceladas-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                $oscaceladas = DB::table('gos_v_inicio_calendario as gvic')
                ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                    $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                })
                ->leftjoinSub($queryenc, 'goe', function ($join) {
                    $join->on('goe.id2', '=', 'gvic.gos_os_id');
                })
                ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                ELSE "Verde" END AS EstadoFechaPromesa'))
                ->where('gvic.gos_taller_id',$idtaller)
                ->whereNotNull('fecha_cancelado')
                ->whereNull('fecha_historico')
                ->groupBy('gos_os_id')
                ->orderBy('gos_os_id','desc')
                ->paginate(50);
                $pagcanc = $oscaceladas->render();
                $conteoProc = $oscaceladas->count();
                $totalProc = $oscaceladas->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
                $compact = compact('pagcanc','oscaceladas','conteoProc','totalProc',
                'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
            return view('OS/pruebasOSlistado/ListarCanceladas',$compact);
        }

        public function resoscan(Request $request){
            $idtaller=Session::get('taller_id');
            //-------------------------------contadores-------------------------------------------------------------------------//
            $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
            $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
            ->where(function($query){
                $query->where('fecha_facturado','!=',NULL)
                    ->orwhere('fecha_historico','!=',NULL)
                        ->orwhere('fecha_cancelado','==',NULL);
            })
            ->count();
            //-------------------------------contadores-------------------------------------------------------------------------//
            //-------------------------------ListarHistorico-------------------------------------------------------------------------//
                $queryenc = DB::table('gos_os_encuesta')
                ->select( 'gos_os_encuesta_id', 'gos_os_id as id2');
                $queryprecio = DB::table('gos_os_item')
                ->select( DB::raw('SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+
                SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id'))
                ->groupBy('gos_os_id');
                if($request->buscadorOS!=null){
                    $search = $request->buscadorOS;
                    
                    $oscaceladas = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_cancelado')
                    ->whereNull('fecha_historico')
                    ->where(function($filter) use ($search){
                            $filter->where('nro_orden_interno', 'like', '%'.$search.'%');

                            $filter->orWhere('fecha_creacion', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_cliente', 'like', '%'.$search.'%');

                            $filter->orWhere('nomb_aseguradora', 'like', '%'.$search.'%');

                            $filter->orWhere('detallesVehiculo', 'like', '%'.$search.'%');

                            $filter->orWhere('asesor', 'like', '%'.$search.'%');
                    })
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                else {
                    $oscaceladas = DB::table('gos_v_inicio_calendario as gvic')
                    ->leftjoinSub($queryprecio, 'gos_total', function ($join) {
                        $join->on('gos_total.id', '=', 'gvic.gos_os_id');
                    })
                    ->leftjoinSub($queryenc, 'goe', function ($join) {
                        $join->on('goe.id2', '=', 'gvic.gos_os_id');
                    })
                    ->select( DB::raw('*, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
                    CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa'))
                    ->where('gvic.gos_taller_id',$idtaller)
                    ->whereNotNull('fecha_cancelado')
                    ->whereNull('fecha_historico')
                    ->groupBy('gos_os_id')
                    ->orderBy('gos_os_id','desc')
                    ->paginate(50);
                }
                $cuentaCanceladas = $oscaceladas->count();


                $pagcanc = $oscaceladas->render();
                $conteoProc = $cuentaCanceladas;
                $totalProc = $oscaceladas->total();
            

            $usuario=Session::get('usr_Data');
            $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
            $osLigadas=Gos_Os_Ligadas::all();
        
            $compact = compact('pagcanc','oscaceladas','conteoProc','totalProc',
            'osLigadas','cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','cuentaCanceladas','taller_conf_vehiculo','taller_conf_ase');
                
                
            return view('OS/pruebasOSlistado/ListarCanceladas',$compact);
        }
    

    public function GetOSProceso()
    {
        $idtaller=Session::get('taller_id');
        // $OSProceso =  Gos_V_Inicio_Calendario::where(self::condIdTaller())->whereNull('fecha_terminado')->get();
        $OSProceso = DB::select( DB::raw('SELECT *, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
        CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
	                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa
        FROM gos_v_inicio_calendario gvic
        LEFT JOIN (SELECT  SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+ SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id 
        FROM gos_os_item
        GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id
        LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
         WHERE  gos_taller_id='.$idtaller.' AND fecha_terminado IS NULL AND fecha_historico IS NULL AND fecha_cancelado IS NULL 
         GROUP BY gvic.gos_os_id
         ORDER BY nro_orden_interno+000000 DESC'));
        $ajax = $this->preparaDataTableAjax($OSProceso, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
         }
        //  $cuentaProces = Gos_V_Inicio_Calendario::where(self::condIdTaller())->whereNull('fecha_terminado')->count();
        $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
        $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
        $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
         $usuario=Session::get('usr_Data');
         $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
         $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
         $name=('Órdenes En Proceso');
         $activePro=('active');
         $os = $OSProceso;
        //  return($os);
         $osLigadas=Gos_Os_Ligadas::all();
         $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activePro','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
         return view($this->getVistaListado(),$compact);
    }

    public function GetOSTerminadas()
    {
         $idtaller=Session::get('taller_id');
        //   $OSTerminadas = Gos_V_Inicio_Calendario::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->get();
        $OSTerminadas =  DB::select( DB::raw('SELECT *, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
        CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
	                WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                    WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                    ELSE "Verde" END AS EstadoFechaPromesa
        FROM gos_v_inicio_calendario gvic    
        LEFT JOIN (SELECT  SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+ SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id 
        FROM gos_os_item
        GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id        
        LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
        LEFT JOIN (SELECT gos_encuesta_id, nombre_encuesta,gos_aseguradora_id as asgid  FROM gos_encuesta  ) as ge ON  ge.asgid =  gvic.gos_aseguradora_id
        WHERE  gvic.gos_taller_id='.$idtaller.' AND fecha_terminado IS NOT NULL AND fecha_historico IS NULL AND fecha_entregado IS NULL AND fecha_cancelado IS NULL
        GROUP BY gvic.gos_os_id
        ORDER BY nro_orden_interno+000000 DESC'));
        
      $ajax = $this->preparaDataTableAjax($OSTerminadas, $this->getOpcionesEditDataTable());
      if (null != $ajax) {
          return $ajax;
      }
      $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
      $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();

     
        //   dd($OSTerminadas);
      $name=('Órdenes Terminadas');
      $activeTer=('active');
      $os = $OSTerminadas;
      $osLigadas=Gos_Os_Ligadas::all();
      $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activeTer','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
      return view($this->getVistaListado(),$compact);
    }

    public function GetOSEntregadas()
    {
     $idtaller=Session::get('taller_id');
      $OsEntregadas = DB::select( DB::raw('SELECT *, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
      CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                  ELSE "Verde" END AS EstadoFechaPromesa
        FROM gos_v_inicio_calendario gvic
        LEFT JOIN (SELECT  SUM(IFNULL(precio_etapa,0)*IFNULL(if(cantidad=0,1,cantidad),1))+ SUM(IFNULL(precio_materiales,0)*IFNULL(if(cantidad=0,1,cantidad),1)) as precio_total, gos_os_id as id 
        FROM gos_os_item
        GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id
        LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
        WHERE  gos_taller_id='.$idtaller.' AND fecha_terminado IS NOT NULL AND fecha_entregado IS NOT NULL AND fecha_facturado IS NULL AND fecha_historico IS NULL AND fecha_cancelado IS NULL
        GROUP BY gvic.gos_os_id
        ORDER BY nro_orden_interno+000000 DESC'));
        // return($OsEntregadas);
      $ajax = $this->preparaDataTableAjax($OsEntregadas, $this->getOpcionesEditDataTable());
      if (null != $ajax) {
          return $ajax;
      }
      $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
      $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
      $name=('Órdenes Entregadas');
      $activeEnt=('active');
      $os = $OsEntregadas;
      $osLigadas=Gos_Os_Ligadas::all();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activeEnt','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
      return view($this->getVistaListado(),$compact);
    }

    public function GetOSHistorico($value='')
    {
      $idtaller=Session::get('taller_id');
      $OsEntregadas = DB::select( DB::raw('SELECT *, REPLACE(gvic.total,",","") as tots,
      CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                  ELSE "Verde" END AS EstadoFechaPromesa
      FROM gos_v_inicio_calendario gvic
      LEFT JOIN (SELECT  SUM(precio_etapa*if(cantidad=0,1,cantidad))+ SUM(precio_materiales*cantidad) as precio_total, gos_os_id as id 
        FROM gos_os_item
        GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id
        LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
       WHERE  gos_taller_id = '.$idtaller.' AND (fecha_facturado IS NOT NULL OR fecha_historico IS NOT NULL  ) 
       GROUP BY gvic.gos_os_id
       ORDER BY nro_orden_interno+000000 DESC'));
      $ajax = $this->preparaDataTableAjax($OsEntregadas, $this->getOpcionesEditDataTable());
      if (null != $ajax) {
          return $ajax;
      }
      $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
      $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
      $name=('Histórico');
      $activeHis=('active');
      $os = $OsEntregadas;
      $osLigadas=Gos_Os_Ligadas::all();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activeHis','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
      return view($this->getVistaListado(),$compact);
    }

    public function GetOSCancelado()
    {
      $idtaller=Session::get('taller_id');
      $OsCanceladas = DB::select( DB::raw('SELECT *, (precio_total *IFNULL((iva_taller / 100),0)) + precio_total as tots,
      CASE WHEN fecha_promesa_os = "0000-00-00 00:00:00" THEN "Sin Fecha"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() < 0 THEN "Rojo"
                  WHEN CAST(fecha_promesa_os as DATE) - CURDATE() <= 2 THEN "Amarillo"
                  ELSE "Verde" END AS EstadoFechaPromesa
      FROM gos_v_inicio_calendario gvic
      LEFT JOIN (SELECT  SUM(precio_etapa*if(cantidad=0,1,cantidad))+ SUM(precio_materiales*cantidad) as precio_total, gos_os_id as id 
  FROM gos_os_item
  GROUP BY gos_os_id ) as gos_total ON gos_total.id = gvic.gos_os_id
  LEFT JOIN (SELECT gos_os_encuesta_id, gos_os_id as id2  FROM gos_os_encuesta  ) as goe ON goe.id2 = gvic.gos_os_id
       WHERE  gos_taller_id='.$idtaller.' AND fecha_cancelado IS NOT NULL AND fecha_historico IS NULL
       GROUP BY gvic.gos_os_id
       ORDER BY nro_orden_interno+000000 DESC'));
      $ajax = $this->preparaDataTableAjax($OsCanceladas, $this->getOpcionesEditDataTable());
      if (null != $ajax) {
          return $ajax;
      }
      $cuentaProces = Gos_Os::where(self::condIdTaller())->whereNull('fecha_terminado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaTerminadas = Gos_Os::where(self::condIdTaller())->where('fecha_terminado','!=',NULL)->whereNull('fecha_entregado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentaEntregadas = Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_terminado','!=',NULL)->where('fecha_entregado','!=',null)->whereNull('fecha_pago')->whereNull('fecha_facturado')->whereNull('fecha_historico')->whereNull('fecha_cancelado')->count();
      $cuentahistorico= Gos_OS::where('gos_taller_id', $idtaller)
        ->where(function($query){
            $query->where('fecha_facturado','!=',NULL)
                ->orwhere('fecha_historico','!=',NULL)
                    ->orwhere('fecha_cancelado','==',NULL);
        })
        ->count();
      $cuentaCanceladas= Gos_OS::where('gos_taller_id', $idtaller)->where('fecha_cancelado','!=',NULL)->whereNull('fecha_historico')->count();
      $name=('Cancelado');
      $activeCan=('active');
      $os = $OsCanceladas;
      $osLigadas=Gos_Os_Ligadas::all();
      $usuario=Session::get('usr_Data');
      $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
      $compact = compact('cuentaProces','cuentaTerminadas','cuentaEntregadas','cuentahistorico','name','activeCan','os','osLigadas','taller_conf_vehiculo','taller_conf_ase','cuentaCanceladas');
      return view($this->getVistaListado(),$compact);
    }
    
    

    public function LigarOs(Request $request){
        $gos_os_id = $request->gos_os_id;
        $gos_os_id_nroInterno = $request->gos_os_id_nroInterno;

        $gos_os_id_ligar = $request->gos_os_id_ligar;
        $nro_orden_interno = $request->nro_orden_interno;

        $liga1 = Gos_Os_Ligadas::where('gos_os_id',$gos_os_id)
                                ->where('gos_os_id_relacion',$gos_os_id_ligar)
                                ->first();

        if(is_null($liga1)){
            $newLigarOS = new Gos_Os_Ligadas;
            $newLigarOS->gos_os_id = $gos_os_id;
            $newLigarOS->gos_os_id_relacion = $gos_os_id_ligar;
            $newLigarOS->nro_orden_interno = $nro_orden_interno;
            $newLigarOS->save();
        }

        $liga2 = Gos_Os_Ligadas::where('gos_os_id',$gos_os_id_ligar)
                                ->where('gos_os_id_relacion',$gos_os_id)
                                ->first();

        if(is_null($liga1)){
            $newLigarOS = new Gos_Os_Ligadas;
            $newLigarOS->gos_os_id = $gos_os_id_ligar;
            $newLigarOS->gos_os_id_relacion = $gos_os_id;
            $newLigarOS->nro_orden_interno = $gos_os_id_nroInterno;
            $newLigarOS->save();
        }

        $ligadas = Gos_Os_Ligadas::where('gos_os_id',$gos_os_id)->get();

        return Response::json($ligadas);
    }
    public function GetOsLigadas($id){
        $ligadas = Gos_Os_Ligadas::where('gos_os_id',$id)->get();
        return Response::json($ligadas);
    }


}
