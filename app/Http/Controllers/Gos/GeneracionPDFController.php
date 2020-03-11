<?php
namespace App\Http\Controllers\Gos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Gos\Gos_V_Os_Generada;
use App\Gos\Gos_Taller;

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
use App\Gos\Gos_V_Vehiculo_Inventario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Gos\Gos_Taller_Conf_vehiculo;
use App\Gos\Gos_Taller_Conf_ase;
use Session;
use NumerosEnLetras;
/**
 *
 * @author andrea
 *
 */
class GeneracionPDFController extends GosControllers
{

    public function exportPdfOS($gos_os_id)
    {
        $idtaller=Session::get('taller_id');
        $os = Gos_V_Os_Generada::find($gos_os_id);
        $usuario_id = Session::get('usr_Data');
        $taller_conf_ase = Gos_Taller_Conf_Ase::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
        $taller_conf_vehiculo = Gos_Taller_Conf_Vehiculo::where('gos_taller_id', $usuario_id->gos_taller_id)->first();
        $row_number = DB::select( DB::raw('SELECT *
        FROM gos_v_inicio_calendario
       WHERE  gos_taller_id='.$idtaller.' AND gos_os_id = '.$gos_os_id.'
       ORDER BY nro_orden_interno ASC
       '));
        $number = $row_number[0]->nro_orden_interno;        
        $listaInteriores = Gos_V_Vehiculo_Inventario::where('tipo', 'Interiores')->where('gos_os_id',$gos_os_id)->get();
        $listaExteriores = Gos_V_Vehiculo_Inventario::where('tipo', 'Exteriores')->where('gos_os_id',$gos_os_id)->get();
        $listaMotores = Gos_V_Vehiculo_Inventario::where('tipo', 'Motor')->where('gos_os_id',$gos_os_id)->get();
        $listaCajuela = Gos_V_Vehiculo_Inventario::where('tipo', 'Cajuela')->where('gos_os_id',$gos_os_id)->get();
        // EN TODOS LOS CASOS REEMPLAZAR Gos_Vehiculo_Parte POR Gos_Vehiculo_Inventario, UNA VEZ INVENTARIO CARGADO EN LA TABLA
        $idinventario = Gos_Vehiculo_Inventario::where('gos_os_id',$gos_os_id)->first();

        $comentario = Gos_Vehiculo_Inventario_Com::where('gos_vehiculo_inventario_id',$idinventario->gos_vehiculo_inventario_id)->first();

        // LINEA DE PRUEBA PARA MOSTRAR EN PDF

        $listataller = Gos_Taller::find(Session::get('taller_id'));        
        // VER FUNCION PARA TOMAR ID DE TALLER
        $firmaPng1 = Gos_Vehiculo_Inventario::select('gos_vehiculo_inventario_id')
        ->where('gos_vehiculo_inventario_id',$idinventario)
        ->first();
        // URL'S
        $css = public_path().'\gos\css\bootstrap.min.css';
        $logo =public_path().Storage::url($listataller->taller_lototipo);      
        // dd($logo);
        $carroceria = public_path().'/img/ccar/'.$idinventario->gos_vehiculo_tipo.'.jpg';
        $carroceria2 = public_path().'\storage\img\firmasOS\Inventario\cc'.$gos_os_id.'.png';
        $medidor = public_path().'\img\medidor-1.png';
        $firma1 = public_path().'\storage\img\firmasOS\Inventario\fe'.$gos_os_id.'.png';
        $firma2 = public_path().'\storage\img\firmasOS\Inventario\fc'.$gos_os_id.'.png';

        $iva=($os->iva/100)+1;
        $totalF=$os->subtotal*$iva;
        $totalletra=NumerosEnLetras::convertir($totalF);
        $totalletra=strtoupper($totalletra);
        $compact = array();
        // traer items de orden de servicio
        $compact = compact('os','listaInteriores', 'listaExteriores', 'listaMotores', 'listaCajuela','listataller', 'comentario','css','logo','carroceria','carroceria2','medidor','firma1','firma2','totalF','totalletra','idinventario','number','taller_conf_vehiculo','taller_conf_ase');


         return PDF::loadView('OS.pdf', $compact)->inline('Ordenes-'.time().'.pdf');
        //return $pdf->download('Ordenes-'.time().'.pdf');
    }


    /**
     *
     * Export PDF Facturacion
     */
    Public function exportPdFacturacion()
    {
      $valores = array(
          'nomb_taller' => 'Fulano'
      );

      $pdf = PDF::loadView('Facturacion.pdf', $valores);

      return $pdf->download('Facturacion-' . time() . '.pdf');
    }

    /**
     *
     * Export PDF Presupuesto
     */
    public function exportPdfPresupuesto()
    {
        $valores = array(
            'nomb_taller' => 'Fulano'
        );

        $pdf = PDF::loadView('Presupuesto.pdf', $valores);

        return $pdf->download('Presupuesto-' . time() . '.pdf');
    }




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
        //
    }
}
