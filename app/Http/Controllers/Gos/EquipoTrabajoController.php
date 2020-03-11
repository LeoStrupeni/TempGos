<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosSistemaParametrosController;

use App\Gos\Gos_EquipoTrabajo;
use App\Gos\Gos_Usuario_Seg_Comision;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_V_Usuarios_Perfiles;
use App\Gos\Gos_Aseguradora;
use App\Gos\Gos_Paq_Servicio;
use App\Gos\Gos_Usuario_Admin_Ase_Comision;
use App\Gos\Gos_Usuario_Segmenta_Comi;
use App\Gos\Gos_Usuario;
use Illuminate\Support\Facades\DB;
use session;

/**
 *
 * @author yois
 *
 */
class EquipoTrabajoController extends GosControllers
{
    protected $vistaListado = 'EquipoTrabajo/ListarEquipoTrabajo';

    protected $opcionesEditDataTable = 'EquipoTrabajo.OpcionesEquipoTrabajoDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaUsuarios = self::listadoGeneral();
        $compact = array_merge($this->preparaCrearEditar(), compact('listaUsuarios'));

        $ajax = $this->preparaDataTableAjax($listaUsuarios, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
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
        return Gos_V_Equipo_Trabajo::where(self::condIdTaller())->get();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaCrearEditar()
     */
    protected function preparaCrearEditar()
    {
        $listaPerfiles = Gos_V_Usuarios_Perfiles::all();
        $listaAseguradora = Gos_Aseguradora::where(self::condIdTaller())->get();
        $listaServicios = Gos_Paq_Servicio::where(self::condIdTaller())->get();
        $listaSegmentacion = Gos_Usuario_Segmenta_Comi::all();

        $compact = compact('listaPerfiles','listaAseguradora','listaServicios','listaSegmentacion');
        return $compact;
    }

/* esta funcion no filtra por email

    public function getLimitUsuarios()
    {
      $idtaller=Session::get('taller_id');

      $usuarios = DB::select('select count(*) as co from gos_v_usuarios where gos_usuario_rol_id=1 and gos_taller_id='.$idtaller);
      $licencias = DB::select('select numero_usuarios from gos_licencia gl inner join gos_taller gt on gl.gos_licencia_id = gt.gos_licencia_id where gos_taller_id ='.$idtaller);

      $l = (int)$licencias[0]->numero_usuarios;
      $u = (int)$usuarios[0]->co;
      return $l - $u;
    }
    */

    public function getLimitUsuarios()
    {
      $idtaller=Session::get('taller_id');

      $usuarios = DB::select('select count(*) as co from gos_v_usuarios where gos_taller_id='.$idtaller.' and email is not null');
      $licencias = DB::select('select numero_usuarios from gos_licencia gl inner join gos_taller gt on gl.gos_licencia_id = gt.gos_licencia_id where gos_taller_id ='.$idtaller);

      $l = (int)$licencias[0]->numero_usuarios;
      $u = (int)$usuarios[0]->co;
      return $l - $u;
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
        //
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
       Gos_Usuario::find($id)->delete();
        return back();
    }

    protected function validaDatos(Request $request)
    {
        /**
         *
         * @var string $nombre
         */
        $nombre = $request->get('Usuario');
        $reglas = [
            'nombre' => 'required'
        ];
        $mensajes = [
            'nombre.required' => 'Falta el nombre'
        ];

        return $this->validate($request, $reglas, $mensajes);
        //
    }

    /**
     * deveulve lista de perfiles con sus roles
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listaPerfilAdmin()
    {
        $rolAdmin = 1; //self::rolAdmin();
        return \App\Gos\Gos_V_Usuarios_Perfiles::all()->where('gos_usuario_rol_id', $rolAdmin);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listaPerfilTecnico()

    {
        $rolTecnico = 2;//self::rolTecnico();
        return \App\Gos\Gos_V_Usuarios_Perfiles::all()->where('gos_usuario_rol_id', $rolTecnico);
    }

    /**
     * devuelve el id de rol de administrador
     */
    public static function rolAdmin()
    {
        $rolAdmin = GosSistemaParametrosController::valorEntero('rol_admin');
    }

    /**
     * devuelve el id de rol de tenico
     */
    public static function rolTecnico()
    {
        $rolAdmin = GosSistemaParametrosController::valorEntero('rol_tecnico');
    }
}
