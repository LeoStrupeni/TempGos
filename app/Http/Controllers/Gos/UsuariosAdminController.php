<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gos\UsuariosGosController;
use App\Gos\Gos_Usuario;
use App\Gos\Gos_Lic_Taller_Usuario;
use App\Gos\Gos_Usuario_Admin_Comision_Ase;
use App\Gos\Gos_Usuario_Admin_Ase_Seguimiento;
use App\Gos\Gos_Usuario_Admin_Comision;
use Illuminate\Http\Request;
use \Response;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Crypt;

/**
 *
 * @author leo
 *
 */
class UsuariosAdminController extends UsuariosGosController

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $equipoTrabajo = self::preparaDatos($request);

        $this->guardaAseguradoraSeguimiento($request);

        if(isset($request->gos_aseguradora_comision_id)){
            $this->guardaAseguradoraComision($request);
            $this->guardaUsuarioComision($request);
        } else {
            $aseguradora = Gos_Usuario_Admin_Comision_Ase::where('gos_usuario_id',$this->getEntidad_id());
            $aseguradora->delete();
            $borrarComision = Gos_Usuario_Admin_Comision::where('gos_usuario_id',$this->getEntidad_id());
            $borrarComision->delete();
        }

        return Response::json($equipoTrabajo);

    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos($request)
    {
        $usuario_admin = null;
        $gos_usuario_id = isset($request->gos_usuario_id) ? $request->gos_usuario_id : 0;

        $datos = $this->preparaDatosUsuario($request);

        if ($gos_usuario_id > 0) {
            $usuario_admin = Gos_Usuario::find($gos_usuario_id)->update($datos);
        } else {
            $usuario_admin = new Gos_Usuario($datos);
            $usuario_admin->save();
            $gos_usuario_id = $usuario_admin->gos_usuario_id;
            $gos_lic_taller = new Gos_Lic_Taller_Usuario();
            $gos_lic_taller->gos_taller_id =  self::tallerIdActual();
            $gos_lic_taller->gos_usuario_id = $gos_usuario_id;
            $gos_lic_taller->save();
        }

        $this->setEntidad_id($gos_usuario_id);

        return $usuario_admin;
    }

    /**
     *
     * @param unknown $request
    */
    protected function guardaAseguradoraSeguimiento($request)
    {
        $listaAseguradoras = $request->gos_aseguradora_seguimiento_id;
        $aseguradora = null;
        if (is_array($listaAseguradoras)) {
            $aseguradora = Gos_Usuario_Admin_Ase_Seguimiento::where('gos_usuario_id',$this->getEntidad_id());
            $aseguradora->delete();

            foreach ($listaAseguradoras as $gos_aseguradora) {
                $datos = $this->datosAseguradora($gos_aseguradora);
                $aseguradora = Gos_Usuario_Admin_Ase_Seguimiento::insert($datos);
            }
        }
        return $aseguradora;
    }

    /**
     *
     * @param unknown $request
    */
    protected function guardaAseguradoraComision($request)
    {
        $listaAseguradoras = $request->gos_aseguradora_comision_id;
        $aseguradora = null;
        if (is_array($listaAseguradoras)) {
            $aseguradora = Gos_Usuario_Admin_Comision_Ase::where('gos_usuario_id',$this->getEntidad_id());
            $aseguradora->delete();

            foreach ($listaAseguradoras as $gos_aseguradora) {
                $datos = $this->datosAseguradora($gos_aseguradora);
                $aseguradora = Gos_Usuario_Admin_Comision_Ase::insert($datos);
            }
        }
        return $aseguradora;
    }

    /**
     *
     * @param unknown $request
    */
    private function datosAseguradora($gos_aseguradora_id)
    {
        return $datos = [
            'gos_usuario_id' => $this->getEntidad_id(),
            'gos_aseguradora_id' => $gos_aseguradora_id
        ];
    }

        /**
     *
     * @param unknown $request
    */
    protected function guardaUsuarioComision($request)
    {
        $usuario = $this->getEntidad_id();

        $borrarComision = Gos_Usuario_Admin_Comision::where('gos_usuario_id',$usuario);
        $borrarComision->delete();

        $comision = new Gos_Usuario_Admin_Comision([
            'gos_usuario_id' => $usuario,
            'gos_usuario_segmenta_comi_id' => $request->gos_usuario_segmenta_comi_id,
            'monto_comision' => $request->monto_comision,
            'comision_tipo' => $request->comision_tipo
        ]);
        $comision->save();

        return $comision;
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
    public function edit($gos_usuario_id)
    {
        $usuario_admin = Gos_Usuario::find($gos_usuario_id);
        $comision = Gos_Usuario_Admin_Comision_Ase::where('gos_usuario_id',$gos_usuario_id)->get();
        $seguimiento = Gos_Usuario_Admin_Ase_Seguimiento::where('gos_usuario_id',$gos_usuario_id)->get();
        $comisionUsuario = Gos_Usuario_Admin_Comision::where('gos_usuario_id',$gos_usuario_id)->first();
        if (strlen($usuario_admin->clave) > 24) {
          $usuario_admin->clave=Crypt::decryptString($usuario_admin->clave);
        }
        if (strlen($usuario_admin->clave_validacion) > 24) {
          $usuario_admin->clave_validacion=Crypt::decryptString($usuario_admin->clave_validacion);
        }
        $datosJson = array(
            'user' => $usuario_admin,
            'comision' => $comision,
            'seguimiento' => $seguimiento,
            'comisionUsuario' => $comisionUsuario
        );

        return Response::json($datosJson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Usuario $usuario_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_usuario_id)
    {
        $usuario_admin = Gos_Usuario::find($gos_usuario_id);
        $usuario_admin->delete();
        return Response::json($usuario_admin);
    }
}
