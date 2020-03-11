<?php

namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\Gos\GosControllers;
use App\Gos\Gos_Requisicion;
use App\Gos\Gos_Requisicion_Item;
use App\Gos\Gos_V_Requisiciones_Items;

class RequisicionItemController extends GosControllers
{
    protected $opcionesEditDataTable = 'Requisicion.OpcionesItemsRequisicionDT';

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gos_requisicion_id)
    {
        $listado = Gos_V_Requisiciones_Items::where(self::condIdTaller())
                                            ->where('gos_requisicion_id',$gos_requisicion_id)
                                            ->get();
        
        $ajax = $this->preparaDataTableAjax($listado, $this->getOpcionesEditDataTable());

        return $ajax;
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
    public function destroy($gos_requisicion_item_id)
    {
        $item = Gos_Requisicion_Item::find($gos_requisicion_item_id);
        $item->delete();
        return Response::json($item);
    }
}
