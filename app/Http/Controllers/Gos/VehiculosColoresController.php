<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gos\Gos_Color;
Use \Response;
use session;
use App\Gos\Gos_Taller_Conf_vehiculo;

/**
 *
 * @author yois
 *
 */
class VehiculosColoresController extends GosControllers
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario=Session::get('usr_Data');
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario->gos_taller_id)->first();
        $idtaller=Session::get('taller_id');
        $colores=Gos_Color::where('gos_taller_id',0)->orwhere('gos_taller_id',$idtaller)->get();
        return view('Vehiculos/ListarColoresVehiculos')->with(compact('colores','taller_conf_vehiculo'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $rules =[
               'codigohex'=>'required',
               'nomb_color'=>'required',
            ];
          $messages=[
              'codigohex.required'=>'Seleccione Un color',
              'nomb_color.required'=>'ingrese el Nombre',
           ];
          $this->validate($request, $rules,$messages);
          $idtaller=Session::get('taller_id');
          $color= new Gos_Color();
          $color->gos_taller_id=$idtaller;
          $color->codigohex=$request->codigohex;
          $color->nomb_color=$request->nomb_color;
          $color->save();
          return back()->with('notification','Color registrado');
    }

    public function eliminar($gos_color_id)
    {
        $nomb_color = Gos_Color::find($gos_color_id);
        $nomb_color->delete();
        return back()->with('notification','Color Eliminado');
    }

}
