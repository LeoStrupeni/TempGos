<?php
namespace App\Http\Controllers\Gos\Paquetes;

use App\Gos\Gos_Paq_Servicio;
use App\Gos\Gos_V_Paq_Servicios;
use App\Gos\Gos_V_Lic_Paq_Servicio;
use Illuminate\Http\Request;
use \Response;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Http\Controllers\Gos\GosControllers;
use Session;
use App\GosClases\GosUtil;

/**
 *
 * @author yois
 *        
 */
class ServiciosController extends GosControllers
{

    protected $opcionesEditDataTable = 'Servicios.OpcionesServiciosDataTable';

    protected $vistaListado = 'Servicios/ListarServicios';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compact = $this->preparaCrearEditar();
        
        $ajax = $this->preparaDataTableAjax(self::listadoGeneral(), $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        
        return view($this->getVistaListado(), $compact);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $idtaller=Session::get('taller_id');
        $listaUsuariosTecnicos = Gos_V_Equipo_Trabajo::where('gos_usuario_rol_id', 2)->where('gos_taller_id', $idtaller)->get();
        return compact('listaUsuariosTecnicos');
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        // lista de servicios del taller y no desde licencia
        return Gos_V_Paq_Servicios::where('gos_taller_id', GosUtil::tallerIdActual());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * $servicio = null;
         * return view('Servicios/EditarServicio', compact('servicio'));
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
        $servicio = $this->preparaDatos($request);
        return Response::json($servicio);
    }

    /**
     *
     * @param unknown $request            
     * @return \App\Gos\Gos_Paq_Servicio
     */
    protected function preparaDatos($request)
    {
        $servicio = null;
        $gos_paq_servicio_id = isset($request->gos_paq_servicio_id) ? $request->gos_paq_servicio_id : 0;
        //
        $datos = $this->datosEntidad($request);
        // si tiene ID
        if ($gos_paq_servicio_id > 0) {
            $servicio = Gos_Paq_Servicio::find($gos_paq_servicio_id)->update($datos);
        } else {
            // creao y guardo datos de la etapa asesor
            $servicio = new Gos_Paq_Servicio($datos);
            $servicio->save();
            $gos_paq_servicio_id = $servicio->Gos_Paq_Servicioa_id;
        }
        $this->setEntidad_id($gos_paq_servicio_id);
        //
        return $servicio;
    }

    /**
     *
     * @param
     *            request
     */
    protected function datosEntidad($request)
    {
        /**
         *
         * @var \App\Gos\Gos_Paq_Servicio $servicio
         */
        $gos_usuario_tecnico_id = isset($request->gos_usuario_tecnico_id) ? $request->gos_usuario_tecnico_id : 0;
        $datos = [
            // 'gos_paq_servicio_id' => $request->get('gos_paq_servicio_id'),
            'nomb_servicio' => $request->nomb_servicio,
            'gos_usuario_tecnico_id' => $gos_usuario_tecnico_id,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'gos_taller_id' => self::tallerIdActual()
        ];
        return $datos;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Paq_Servicio $gos_Servicio            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_paq_servicio_id)
    {
        // FUNCION USADA EN ITEMS DE OS
        $servicio = Gos_V_Paq_Servicios::find($gos_paq_servicio_id);
        return $servicio;
    }

    /**
     * mostrar formulario para editar un servicio elegido
     *
     * @param \App\Product $servicio            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_paq_servicio_id)
    {
        $where = array(
            'gos_paq_servicio_id' => $gos_paq_servicio_id
        );
        $listaDatos = Gos_Paq_Servicio::where($where)->first();
        return Response::json($listaDatos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Paq_Servicio $gos_Servicio            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Paq_Servicio $gos_Servicio)
    {
        $listaDatos = self::preparaDatos($request);
        return $listaDatos->toJson();
    }

    /**
     * borrar servicio con id definido.
     *
     * @param
     *            \App\Gos\Gos_Paq_Servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_paq_servicio_id)
    {
        $listaDatos = Gos_Paq_Servicio::find($gos_paq_servicio_id);
        $listaDatos->delete();
        return Response::json($listaDatos);
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
        $nombre = $request->get('modelo_vehiculo');
        $reglas = [
            'nomb_servicio' => 'required|unique:gos_servicio,nomb_servicio'
        
        ];
        $mensajes = [
            'nomb_servicio.required' => 'Falta servicio',
            'nomb_servicio.unique' => 'Servicio existente'
        ];
        
        return $this->validate($request, $reglas, $mensajes);
        //
    }
    public function salvarOrden($gos_paq_servicio_id, $orden_servicio){
        $servicio = Gos_Paq_Servicio::find($gos_paq_servicio_id);
        $datos = array(
            'orden_servicio'=>$orden_servicio
        );
        $servicio->update($datos);
        return $gos_paq_servicio_id;
    }
}
