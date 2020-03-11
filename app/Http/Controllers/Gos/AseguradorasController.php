<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Region_Municipio;
use App\Gos\Gos_V_Min_Municipios;
use App\Gos\Gos_Region_Localidad;
use App\Gos\Gos_V_Aseguradoras_Resumen;
use App\Gos\Gos_V_Min_Aseguradoras;
use App\Gos\Gos_Region_Colonia;
use App\Gos\Gos_Ase_Fac;
use App\Gos\Gos_Ase_OS;
use App\Gos\Gos_Ase_Cond_Cred;
use App\Gos\Gos_V_Aseguradoras_;
use App\Gos\Gos_Taller_Conf_ase;
use Session;

/**
 *
 * @author yois
 *        
 */
class AseguradorasController extends GosControllers
{

    protected $vistaListado = 'Aseguradoras/ListarAseguradoras';

    protected $opcionesEditDataTable = 'Aseguradoras.OpcionesDataTable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaAseguradoras = self::listadoGeneral();
        $compact = array_merge($this->preparaCrearEditar(), compact('listaAseguradoras'));
        $usuario=Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario->gos_taller_id)->first();
        // dd($compact);
        /**
         * preparar ajax
         */
        $ajax = $this->preparaDataTableAjax($listaAseguradoras, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), $compact)->with(compact('taller_conf_ase'));
    }

    /**
     *
     * @param string $criterio            
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Aseguradoras_Resumen::where(self::condIdTaller());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * $a = null;
         * return view('Aseguradoras/EditarAseguradora', compact('a'));
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
        // return($request);
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
        // mostrar todo el request del post
        // dd($request);
        /**
         *
         * @var \App\Gos\Gos_Aseguradora $aseguradora
         */
        $aseguradora = $this->preparaDatos($request);
        
        $this->guardaDatosRelacionados($request);
        $this->guardaDatosConfiguracionOS($request);
        
        return Response::json($aseguradora);
        
        // if ($this->getEntidad_id() > 0) {
        // //
        // $this->guardaDatosRelacionados($request);
        // return Response::json($aseguradora);
        // } else {
        // return '';
        // }
    }

    /**
     *
     * @param unknown $request            
     * @return \App\Gos\Gos_Aseguradora
     */
    protected function preparaDatos($request)
    {
        $a = null;
        $gos_aseguradora_id = isset($request->gos_aseguradora_id) ? $request->gos_aseguradora_id : 0;
        //
        $datos = $this->datosEntidad($request);
        // dd($datos);
        if ($gos_aseguradora_id > 0) {
            Gos_Aseguradora::find($gos_aseguradora_id)->update($datos);
        } else {
            $a = new Gos_Aseguradora($datos);
            $a->save();
            $gos_aseguradora_id = $a->gos_aseguradora_id;
        }
        //
        $this->setEntidad_id($gos_aseguradora_id);
        // dd($gos_aseguradora_id);
        return $a;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\ClientesController::guardaDatosFacturacion()
     */
    protected function guardaDatosFacturacion($request)
    {
        $f = null;
        $relacion_id = $this->getEntidad_id();
        // guardar datos de facturacion
        $datos = $this->datosFacturacionAseg($request, true, true);
        // dd($datos);
        // esto deveria devolver true o false en cualquier condicion
        if (! Gos_Ase_Fac::find($relacion_id)) {
            $f = new Gos_Ase_Fac($datos);
            $f->save();
        } else {
            $f = Gos_Ase_Fac::where('relacion_id', $relacion_id)->update($datos);
        }
        
        return $f;
    }
    protected function guardaDatosConfiguracionOS($request)
    {
        $f = null;
        $relacion_id = $this->getEntidad_id();
        // guardar datos de facturacion
        $datos = $this->datosOSAseg($request);
        // dd($datos);
        // esto deveria devolver true o false en cualquier condicion
        if (! Gos_Ase_OS::find($relacion_id)) {
            $f = new Gos_Ase_OS($datos);
            $f->save();
        } else {
            $f = Gos_Ase_OS::where('relacion_id', $relacion_id)->update($datos);
        }
        
        return $f;
    }
    protected function datosOSAseg($request)
    {
        $relacion_id = $this->getEntidad_id();
     
        $datos = [
            'relacion_id' => $relacion_id,
            'tot_os' => $request->tot_os == 'on' ? '1' : '0',
            'poliza_os' => $request->poliza_os == 'on' ? '1' : '0',
            'siniestro_os' => $request->siniestro_os == 'on' ? '1' : '0',
            'riesgo_os' => $request->riesgo_os == 'on' ? '1' : '0',
            'reporte_os' => $request->reporte_os == 'on' ? '1' : '0',
            'orden_os' => $request->orden_os == 'on' ? '1' : '0',
            'demerito_os' => $request->demerito_os == 'on' ? '1' : '0',
            'deducible_os' => $request->deducible_os == 'on' ? '1' : '0',
            'encuesta_os' => $request->encuesta_os == 'on' ? '1' : '0',
            'condiciones_os' => $request->condiciones_os == 'on' ? '1' : '0',
            'grua_os' => $request->grua_os == 'on' ? '1' : '0',
        ];
        
        return array_merge($datos);
    }
    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\ClientesController::guardaCondCredito()
     */
    protected function guardaCondCredito($request)
    {
        $cc = null;
        $relacion_id = $this->getEntidad_id();
        $datos = $this->datosCondCredito($request);
        // dd($datos);
        if (! Gos_Ase_Cond_Cred::find($relacion_id)) {
            $cc = new Gos_Ase_Cond_Cred($datos);
            $cc->save();
        } else {
            $cc = Gos_Ase_Cond_Cred::where('relacion_id', $relacion_id)->update($datos);
        }
        return $cc;
    }

    /**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        /**
         * `empresa` VARCHAR(255) NULL,
         * `contacto` VARCHAR(255) NULL,
         * `telefono_fijo` VARCHAR(255) NULL,
         * `celular` VARCHAR(255) NULL,
         * `email_enlace` VARCHAR(255) NULL,
         */
        return [
            'gos_taller_id' => self::tallerIdActual(),
            'empresa' => $request->empresa,
            'contacto' => $request->contacto,
            'telefono_fijo' => $request->telefono_fijo,
            'celular' => $request->celular,
            'email_enlace' => $request->email_enlace
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Aseguradora $gos_Aseguradora            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Aseguradora $gos_Aseguradora)
    {
        //
    }

    /**
     * mostrar formulario para editar una aseguradora elegida
     *
     * @param \App\Product $a            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_aseguradora_id)
    {
        $this->setEntidad_id($gos_aseguradora_id);
        $aseguradora = Gos_V_Aseguradoras_::find($gos_aseguradora_id);
        return($aseguradora);
        return Response::json($aseguradora);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Aseguradora $gos_Aseguradora            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Aseguradora $gos_Aseguradora)
    {
        return $this->guardaJson($request);
    }

    /**
     * borrar aseguradora con id definido.
     *
     * @param
     *            \App\Gos\Gos_Aseguradora
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_aseguradora_id)
    {
        $aseguradora = Gos_Aseguradora::find($gos_aseguradora_id);
        $aseguradora->delete();
        return Response::json($aseguradora);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $listaTipoPersonas = $this->listaTipoPersonaFactura();
        //
        $regiones = $this->obtenListaSelectRegiones();
        $compact = array_merge($regiones, compact('listaTipoPersonas'));
        return $compact;
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
            'nomb_aseguradora' => 'required|unique:gos_aseguradora,nomb_aseguradora'
        
        ];
        $mensajes = [
            'nomb_aseguradora.required' => 'Falta aseguradora',
            'nomb_aseguradora.unique' => 'Aseguradora existente'
        ];
        
        return $this->validate($request, $reglas, $mensajes);
        //
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaMinAseguradoras()
    {
        return Gos_V_Min_Aseguradoras::all();
    }
}
