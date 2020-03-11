<?php
namespace App\Http\Controllers\Gos\SoloPruebas;

use Illuminate\Http\Request;
use App\Http\Controllers\Gos\GosControllers;
use GosClases\ItemsOS;
use GosClases\GosDataTable;
use App\Gos\Gos_Os_Item;
use App\Gos\Gos_OS;
use GosClases\GosData;
use GosClases\Usuarios;
use App\GosClases\OS;
use Illuminate\Support\Facades\DB;

/**
 * Clase para desarrollos independientes
 *
 * @author yois
 *        
 */
class PruebasYOISController extends GosControllers
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gos_os_id = 70;
        $os_id = 70;
        $os_item_id = 4;
        // inicar etapa
        OS::iniciaServicio($gos_os_id);
        // Pago Total
        // OS::preparaEtapasPerdidaTotal($os_item_id, $os_id);
        // Pago De Daños
        // OS::preparaEtapasPagoDanios($os_item_id, $os_id);
        // Etapas Ligadas
        OS::preparaEtapasLigadas($os_item_id, $os_id);
        // $datos_data_table = $this->datosDataTableOpciones($gos_os_id);
        // $listaEtapas = ItemsOS::listaEtapasOS($gos_os_id);
        // $compact = compact(/**'listaEtapas',**/'datos_data_table');
        return view('OS/Generada/OSGeneradaEtapas');
    }

    /**
     * Obtiene datos para DataTableConOpciones
     *
     * @return string|\GosClases\unknown|\GosClases\NULL
     */
    private function datosDataTableOpciones($gos_os_id)
    {
        /**
         *
         * @var Ambiguous $lista_data_table
         */
        $lista_data_table = ItemsOS::listaEtapasOS($gos_os_id);
        // prepara lista de Asesores a seleccionar
        $la = Usuarios::listaAsesoresTaller();
        $opciones_editor = [
            'gos_usuario_id' => $la
        ];
        $datos_data_table = GosDataTable::preparaDataTableAjax($lista_data_table, '', 'Opciones', $opciones_editor);
        // dd($datos_data_table);
        return $datos_data_table;
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

    /* YOIS */
    
    /**
     *
     * @param unknown $gos_os_id            
     * @return \GosClases\unknown|\GosClases\NULL
     */
    public function listaEtapasOS($gos_os_id)
    {
        return $this->datosDataTableOpciones($gos_os_id);
    }

    /**
     * guarda datos del item a guardar
     *
     * @return \GosClases\unknown|\GosClases\NULL|\Illuminate\Http\RedirectResponse
     */
    public function guardaDatos()
    {
        $r = $_POST;
        $nombid = 'gos_os_item_id';
        $idl = 0;
        $d = isset($r['data']) ? $r['data'] : null;
        if ($d) {
            $c = GosData::capturaCampos($nombid, $d);
            $item = Gos_Os_Item::find($c[$nombid]);
            if ($item) {
                $item->update($c);
                $idl = $item->gos_os_id;

                 $dd = DB::select( DB::raw("SELECT SUM(precio_etapa) as precio_etapa
                 FROM gos_os_item
                 WHERE  gos_os_id= ".$idl."
                 GROUP BY gos_os_id "));
                 $os = Gos_OS::find($idl);
         
                $os->subtotal = $dd[0]->precio_etapa;
                $os->update();
            }
        }
        if ($idl > 0) {
            return $this->listaEtapasOS($idl);
        } else
            return back();
    }

    /**
     * Actualiza los datos de un asesor
     *
     * @param unknown $request            
     * @return unknown
     */
    public function actualizaAsesor($request)
    {
        //
        $gos_usuario_asesor_id = $request->gos_usuario_asesor_id;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return response()->json(ItemsOS::actualizaAsesor($gos_os_item_id, $gos_usuario_asesor_id));
    }

    /**
     * Actualiza el precio de la etapa
     *
     * @param unknown $request            
     * @return unknown
     */
    public function actualizaPrecioEtapa($request)
    {
        //
        $precio_etapa = $request->precio_etapa;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return response()->json(ItemsOS::actualizaPrecioEtapa($gos_os_item_id, $precio_etapa));
    }

    /**
     * Actualiza el precio de materiales
     *
     * @param unknown $request            
     * @return unknown
     */
    public function actualizaPrecioMateriales($request)
    {
        //
        $precio_materiales = $request->precio_materiales;
        $gos_os_item_id = $request->gos_os_item_id;
        //
        return response()->json(ItemsOS::actualizaPrecioMateriales($gos_os_item_id, $precio_materiales));
    }
    
    /* YOIS */
}
