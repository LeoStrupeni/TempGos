<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gos\UsuariosGosController;
use Illuminate\Http\Request;
use App\Gos\Gos_Lic_Taller_Usuario;
use Illuminate\Validation\Validator;
use App\Gos\Gos_Usuario;
use App\Gos\Gos_Usuario_Tecnico_Comision;
use App\Gos\Gos_Usuario_Tecnico_Servicios_Asoc;

use \Response;

/**
 *
 * @author leo
 *        
 */
class UsuariosTecnicosController extends UsuariosGosController
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
        
        $this->guardaDatosRelacionados($request);
        
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
        $usuario_tecnico = null;
        $gos_usuario_id = isset($request->gos_usuario_id) ? $request->gos_usuario_id : 0;

        $datos = $this->preparaDatosUsuario($request);

        if ($gos_usuario_id > 0) {
            $usuario_tecnico = Gos_Usuario::find($gos_usuario_id)->update($datos);
        } else {
            $usuario_tecnico = new Gos_Usuario($datos);
            $usuario_tecnico->save();   
    
            $gos_usuario_id = $usuario_tecnico->gos_usuario_id;
            $gos_lic_taller = new Gos_Lic_Taller_Usuario();
            $gos_lic_taller->gos_taller_id =  self::tallerIdActual();
            $gos_lic_taller->gos_usuario_id = $gos_usuario_id;
            $gos_lic_taller->save();
        }

        $this->setEntidad_id($gos_usuario_id);
        
        return $usuario_tecnico;
    }

     /**
     *
     * @param unknown $request
     */
    protected function guardaDatosRelacionados($request)
    {
        $gos_usuario_id = $this->getEntidad_id();  

        /** SERVICIOS ASOCIADOS */
        $listaServicios = $request->gos_paq_servicio_id;
        $servicio=null;
        if (is_array($listaServicios)) {    
            $servicio = Gos_Usuario_Tecnico_Servicios_Asoc::where('gos_usuario_id',$gos_usuario_id);
            $servicio->delete();
        
            foreach ($listaServicios as $servicioAsociar) {
                $datos = ['gos_usuario_id' => $gos_usuario_id,
                          'gos_paq_servicio_id' => $servicioAsociar
                         ];
                $servicio = Gos_Usuario_Tecnico_Servicios_Asoc::insert($datos);
            }
        }

        /** COMISIONES */
        $borrarComision = Gos_Usuario_Tecnico_Comision::where('gos_usuario_id',$gos_usuario_id);
        $borrarComision->delete();

        $comision = new Gos_Usuario_Tecnico_Comision([
            'gos_usuario_id' => $gos_usuario_id,
            'monto_comision' => $request->monto_comision,
            'tipo_comision' => $request->tipo_comision,
            'monto_comision_materiales' => $request->monto_comision_materiales,
            'tipo_comision_materiales' => $request->tipo_comision_materiales,
        ]);
        $comision->save();

        return $gos_usuario_id;
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
        $user = Gos_Usuario::find($gos_usuario_id);
        $comision = Gos_Usuario_Tecnico_Comision::where('gos_usuario_id',$gos_usuario_id)->first();
        $servicios = Gos_Usuario_Tecnico_Servicios_Asoc::where('gos_usuario_id',$gos_usuario_id)->get();
        
        $datosJson = array(
            'user' => $user,
            'comision' => $comision,
            'servicios' => $servicios
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
    public function update(Request $request, Gos_Usuario_Tecnico $usuario_id)
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
        $usuario = Gos_Usuario::find($gos_usuario_id);
        $usuario->delete();
        return Response::json($usuario);
    }
}
