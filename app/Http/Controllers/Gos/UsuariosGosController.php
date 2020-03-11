<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *
 * @author yois
 *
 */
class UsuariosGosController extends GosControllers
{

    /**
     * prepara la fechas del usuario
     *
     * @param unknown $usuario
     * @return unknown
     */
    protected function preparaFechasUsuario($usuario)
    {
        $fecha_contratacion = $usuario->fecha_contratacion;
        $fecha_nacimineto = $usuario->fecha_nacimineto;
        $usuario->fecha_contratacion = $this->convierteFechaDesdeMySQLFormat($fecha_contratacion);
        $usuario->fecha_nacimineto = $this->convierteFechaDesdeMySQLFormat($fecha_nacimineto);
        return $usuario;
    }

    /**
     *
     * @param unknown $request
     * @return number[]|string[]|NULL[]
     */
    protected function preparaDatosUsuario($request)
    {
        $fecha_contratacion = $this->convierteFechaHaciaMySQLFormat($request->fecha_contratacion);
        $fecha_nacimiento = $this->convierteFechaHaciaMySQLFormat($request->fecha_nacimineto);
        // encriptar clave
        // $clave = encrypt($request->clave);
        //Crypt::decryptString()
        $datos = [
            'gos_usuario_perfil_id' => $request->gos_usuario_perfil_id,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'clave' =>  $request->clave,
            'clave_validacion' => $request->clave_validacion,
            'sueldo' => $request->sueldo,
            'genero' => $request->genero,
            'telefono' => $request->telefono,
            'domicilio' => $request->domicilio,
            'fecha_contratacion' => $fecha_contratacion,
            'fecha_nacimineto' => $fecha_nacimiento,
            'nro_seguro_social' => $request->nro_seguro_social,
            'nro_empleado' => $request->nro_empleado
        ];
        return $datos;

    }

}
