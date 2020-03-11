<?php

namespace App\Http\Controllers\Gos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use \Response;
use session;

use App\Gos\Gos_Prestamo;
use App\Gos\Gos_Prestamo_Pagos;
use App\Gos\Gos_V_Prestamos;
use App\Gos\Gos_V_Prestamos_Pagos;
use App\Gos\Gos_V_Prestamos_Historial;
use App\Gos\Gos_V_Equipo_Trabajo;
use App\Gos\Gos_Usuario;


class PrestamosController extends GosControllers
{
    public function index()
    {
        $listaEmpleados = Gos_V_Equipo_Trabajo::select('gos_taller_id','gos_usuario_id','nomb_rol','perfil','fecha_contratacion','nombre_apellidos')->where(self::condIdTaller())->get();
        $listaPrestamos = Gos_V_Prestamos::where(self::condIdTaller())->get();
        
        $ajax = $this->preparaDataTableAjax($listaPrestamos, 'Prestamos.OpcionesPrestamos');
        if (null !== $ajax) {
            return $ajax;
        }

        return view('Prestamos/ListaPrestamos',compact('listaEmpleados'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $gos_prestamo_id = isset($request->gos_prestamo_id) ? $request->gos_prestamo_id : 0;
        $fecha = $this->convierteFechaHaciaMySQLFormat($request->fecha);

        $datos = [
            'gos_usuario_id' => $request->gos_usuario_id,
            'gos_taller_id' => Session::get('taller_id'),
            'observaciones' => $request->observaciones,
            'fecha' => $fecha,
            'total' => $request->monto
        ];

        if ($gos_prestamo_id > 0) {
            Gos_Prestamo::find($gos_prestamo_id)->update($datos);
        } else {
            $prestamo = new Gos_Prestamo($datos);
            $prestamo->save();
        }

        return 1;
    }

    public function storePago(Request $request)
    {
        $fecha = $this->convierteFechaHaciaMySQLFormat($request->fechaPago);

        $pago = new Gos_Prestamo_Pagos([
                'gos_prestamo_id' => $request->gos_prestamo_id,
                'fechaPago' => $fecha,
                'importe' => $request->importePago
            ]);

        $pago->save();

        return 1;
    }

    public function HistorialPrestamos($gos_usuario_id)
    {
        $prestamos= Gos_V_Prestamos_Historial::where(self::condIdTaller())
                                            ->where('gos_usuario_id',$gos_usuario_id)   
                                            ->orderby('Fecha','asc')
                                            ->orderby('Prestamo','desc')
                                            ->get();

        $ajax = $this->preparaDataTableAjax($prestamos, '');
        return $ajax;        
    }

    public function show($id)
    {
        //
    }

    public function edit($gos_prestamo_id)
    {
        $prestamo= Gos_V_Prestamos::where(self::condIdTaller())
                                    ->where('gos_prestamo_id',$gos_prestamo_id)   
                                    ->first();
        return Response::json($prestamo);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($gos_prestamo_id)
    {
        $prestamo = Gos_Prestamo::find($gos_prestamo_id);
        $prestamo->delete();
        return Response::json($prestamo);
    }
}
