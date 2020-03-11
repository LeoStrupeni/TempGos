<?php
namespace App\Http\Controllers\Gos\Paquetes;

use App\Http\Controllers\Gos\OS\ItemsController;
use Illuminate\Http\Request;
use \Response;
use App\Gos\Gos_Paquete_Item;
use GosClases\PaqueteItems;

/**
 *
 * @author leo y yois
 *        
 */
class PaquetesItemsController extends ItemsController
{

    protected $vistaEdicion = 'Paquetes.OpcionesItemsDatatable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
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
        $p = PaqueteItems::guardaEntidadPrincipal($request);
        return Response::json($p);
    }

    /**
     *
     * @param unknown $request            
     * @return \Http\Controllers\Gos\OS\number[]|\Http\Controllers\Gos\OS\NULL[]
     */
    protected function datosItemEtapas($request)
    {
        return parent::datosItemEtapas($request);
    }


    public function TecnicoServicio(Request $request){
        $ositmid=$request->OSitemid;
        $item=Gos_Paquete_Item::find($ositmid);
        $item->gos_usuario_asesor_id=$request->Tecnico;
        $item->save();
       
        return($ositmid);
      }
    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_paquete_id)
    {
        $l = PaqueteItems::listaPorID($gos_paquete_id);
        return self::preparaDataTableAjax($l, $this->getVistaEdicion());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::listadoGeneral()
     */
    public static function listadoFiltrado($gos_paquete_id)
    {
        /**
         * Clase de GosClass PaqueteItems
         */
        return PaqueteItems::listaPorID($gos_paquete_id);
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
    public function destroy($gos_paquete_item)
    {
        $e = PaqueteItems::borraEtapa($gos_paquete_item);
        return Response::json($e);
    }

    public function salvarOrden($gos_paq_etapa_id, $orden_etapa){
        $etapa = Gos_Paquete_Item::find($gos_paq_etapa_id);
        $datos = array(
            'orden_etapa'=>$orden_etapa
        );
        $etapa->update($datos);
        return $gos_paq_etapa_id;
    }
}
