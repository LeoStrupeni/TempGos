<?php
namespace App\Http\Controllers\Gos\OS;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Gos\GosControllers;
use App\Gos\Gos_Vehiculo_Parte;
use App\Gos\Gos_Vehiculo_Medidor_Gas;
use App\Gos\Gos_Vehiculo_Tipo;

use App\Gos\Gos_V_Os;
use App\Gos\Gos_V_Inventario_Vehiculo;
use App\Gos\Gos_V_Inventario_Vehiculo_Parte;

use App\Gos\Gos_Vehiculo_Inventario;
use App\Gos\Gos_Vehiculo_Inventario_Carroceria;
use App\Gos\Gos_Vehiculo_Inventario_Com;
use App\Gos\Gos_Vehiculo_Inventario_Doc;
use App\Gos\Gos_Vehiculo_Inventario_Parte;

class InventarioVehiculoController extends GosControllers
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function generarIdInventario(Request $request)
    {
        $gos_vehiculo_inventario_id = null;
        $inventarioV = null;
        $inventarioV = new Gos_Vehiculo_Inventario([
            'gos_os_id' => $request->gos_os_id,
            'gos_vehiculo_id' => $request->gos_vehiculo_id,
            'gos_vehiculo_medidor_gas_id' => '9'
            ]);
        $inventarioV->save();

        $gos_vehiculo_inventario_id = $inventarioV->gos_vehiculo_inventario_id;

        $listadoPartesVehiculo = Gos_Vehiculo_Parte::all();
        $partes = null;

        foreach ($listadoPartesVehiculo as $parteVehiculo) {
            $partes = new Gos_Vehiculo_Inventario_Parte([
                'gos_vehiculo_inventario_id' => $gos_vehiculo_inventario_id,
                'gos_vehiculo_parte_id' => $parteVehiculo->gos_vehiculo_parte_id
            ]);
            $partes->save();
            $partes=null;
        }

        return $inventarioV;
    }


    public function store(Request $request)
    {
        /** Actualizacion Inventario */
        $inventarioV = Gos_Vehiculo_Inventario::find($request->gos_vehiculo_inventario_id);
        if($request->medidor_gasolina!==null){
        $inventarioV->update([
                        'gos_vehiculo_medidor_gas_id' => $request->medidor_gasolina,
                        'kilometraje' =>  $request->get('8_cantidad')
                    ]);
        }
        /**Vehiculo partes del inventario */
        $listadoPartesVehiculo = Gos_Vehiculo_Parte::select('gos_vehiculo_parte_id')->get();
        foreach ($listadoPartesVehiculo as $parte) {

            $revisada = ($request->get($parte->gos_vehiculo_parte_id.'_revisada') == 'si' ? '1' : '0');
            $cantidad = $request->get($parte->gos_vehiculo_parte_id.'_cantidad');

            $gos_vehiculo_inventario_parte_id = $request->get($parte->gos_vehiculo_parte_id.'_gos_vehiculo_inventario_parte_id');

            $actualizacionParte = Gos_Vehiculo_Inventario_Parte::find($gos_vehiculo_inventario_parte_id);
            $actualizacionParte ->update([
                'revisada' => $revisada,
                'cantidad' => $cantidad
            ]);
        }

        /** Comentario del inventario */
        $gos_vehiculo_inventario_com_id = isset($request->gos_vehiculo_inventario_com_id) ? $request->gos_vehiculo_inventario_com_id : 0;

        if ($gos_vehiculo_inventario_com_id > 0) {
            Gos_Vehiculo_Inventario_Com::find($gos_vehiculo_inventario_com_id)
                                    ->update(['comentarios' => $request->comentario_propio_del_inventario]);
        } else {
            $comentario = new Gos_Vehiculo_Inventario_Com([
                'gos_vehiculo_inventario_id' => $request->gos_vehiculo_inventario_id,
                'comentarios' => $request->comentario_propio_del_inventario
            ]);
            $comentario->save();
        }

        /** Tipo de carroceria del inventario */
        $gos_vehiculo_inventario_carroceria_id = isset($request->gos_vehiculo_inventario_carroceria_id) ? $request->gos_vehiculo_inventario_carroceria_id : 0;
        if($request->modelo_vehiculo!==null){
            if ($gos_vehiculo_inventario_carroceria_id > 0) {
                Gos_Vehiculo_Inventario_Carroceria::find($gos_vehiculo_inventario_carroceria_id)
                                        ->update(['gos_vehiculo_tipo_id' => $request->modelo_vehiculo]);
            } else {
                $carroceria = new Gos_Vehiculo_Inventario_Carroceria([
                    'gos_vehiculo_inventario_id' => $request->gos_vehiculo_inventario_id,
                    'gos_vehiculo_tipo_id' => $request->modelo_vehiculo
                ]);
                $carroceria->save();
            }
        }

        return $inventarioV;
    }
   

    public function CanvasInventario(Request $request){

        $id=$request->id;
        $bg=$request->bg;
        $CVScarroceria = $request->carroseria;  // your base64 encoded
        $CVScarroceria = str_replace('data:image/png;base64,', '', $CVScarroceria);
        $CVScarroceria = str_replace(' ', '+', $CVScarroceria);

        $CVSencargado = $request->encargado;  // your base64 encoded
        $CVSencargado = str_replace('data:image/png;base64,', '', $CVSencargado);
        $CVSencargado = str_replace(' ', '+', $CVSencargado);

        $CVScliente =$request->cliente; // your base64 encoded
        $CVScliente = str_replace('data:image/png;base64,', '', $CVScliente);
        $CVScliente = str_replace(' ', '+', $CVScliente);





       $inventarioV = Gos_Vehiculo_Inventario::where('gos_os_id',$id)->first();
        if ($inventarioV->firma_asesor==Null) {
          $inventarioV->firma_asesor= "storage/img/firmasOS/Inventario/fe".$id.".png";
          Storage::disk('public')->put("img/firmasOS/Inventario/fe".$id.".png", base64_decode($CVSencargado));
        }
        if ($inventarioV->firma_cliente==NUll) {
          $inventarioV->firma_cliente= "storage/img/firmasOS/Inventario/fc".$id.".png";
          Storage::disk('public')->put("img/firmasOS/Inventario/fc".$id.".png", base64_decode($CVScliente));
        }
        if ($inventarioV->gos_vehiculo_tipo==NULL) {
             $inventarioV->gos_vehiculo_tipo=$bg;
             Storage::disk('public')->put("img/firmasOS/Inventario/cc".$id.".png", base64_decode($CVScarroceria));
        }

       $inventarioV->save();

        return($request);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_os_id)
    {
        // $os = Gos_V_Os::find($gos_os_id);
        // $listaInteriores = Gos_V_Inventario_Vehiculo_Parte::where('tipo', 'Interiores')->get();
        // $listaExteriores = Gos_V_Inventario_Vehiculo_Parte::where('tipo', 'Exteriores')->get();
        // $listaMotores = Gos_V_Inventario_Vehiculo_Parte::where('tipo', 'Motor')->get();
        // $listaCajuela = Gos_V_Inventario_Vehiculo_Parte::where('tipo', 'Cajuela')->get();
        // $listaMedidorGas = Gos_Vehiculo_Medidor_Gas::all();
        // $listaTipoVehiculo = Gos_Vehiculo_Tipo::all();
        // $datosOS = array();
        // $datosOS = compact('os', 'listaInteriores', 'listaExteriores', 'listaMotores', 'listaCajuela', 'listaMedidorGas', 'listaTipoVehiculo');

        // return Response::json($datosOS);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

        /**
     *
     * @return array
     */
    protected function obtenListasRecursosInvetnario()
    {
        // varlores para inventario
        $interiores = array();
        $listaMotores = array();
        $exteriores = array();
        $listaCajuelas = array();
        $medidores = array();
        $vehiculos = array();
        // imagen firma del encargado
        $firma_encargado = ''; // data:image/png;base64 sumar codigo base 64
        $firma_cliente = ''; // data:image/png;base64 sumar codigo base 64

        return compact('interiores', 'listaMotores', 'exteriores', 'listaCajuelas', 'medidores', 'vehiculos', 'firma_encargado', 'firma_cliente');
    }

}
