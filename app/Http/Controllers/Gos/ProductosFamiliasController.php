<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;

use App\Gos\Gos_Producto_Familia;

/**
 *
 * @author yois
 *        
 */
class ProductosFamiliasController extends GosControllers
{
    protected $vistaListado = 'Familias/ListarFamilia';

    protected $opcionesEditDataTable = 'Familias.OpcionesFamiliasDatatable';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaFamilias = $this->listadoGeneral();

        $ajax = $this->preparaDataTableAjax($listaFamilias, $this->getOpcionesEditDataTable());
        if (null != $ajax) {
            return $ajax;
        }
        return view($this->getVistaListado(), compact('listaFamilias'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_Producto_Familia::where(self::condIdTaller())->get();
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
     * Agregar nueva familia de productos.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nomb_familia' => 'required'
        // ]);
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
        $familia = $this->preparaDatos($request);
        return Response::json($familia);
    }

    /**
     *
     * @param
     *            request
     */
    protected function preparaDatos($request)
    {
        $familia = null;
        $gos_producto_familia_id = isset($request->gos_producto_familia_id) ? $request->gos_producto_familia_id : 0;
        $datos = $this->datosEntidad($request);
        if ($gos_producto_familia_id > 0) {
            $familia = Gos_Producto_Familia::find($gos_producto_familia_id)->update($datos);
        } else {
            $familia = new Gos_Producto_Familia($datos);
            $familia->save();
            $gos_producto_familia_id = $familia->gos_producto_familia_id;
        }

        $this->setEntidad_id($gos_producto_familia_id);

        return $familia;
    }

/**
     *
     * @param unknown $request            
     * @return number[]|NULL[]
     */
    protected function datosEntidad($request)
    {
        return [
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_familia' => $request->nomb_familia
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Familia $gos_Producto_Familia            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Producto_Familia $gos_Producto_Familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Producto_Familia $gos_Producto_Familia            
     * @return \Illuminate\Http\Response
     */
    public function edit($gos_producto_familia_id)
    {
        $this->setEntidad_id($gos_producto_familia_id);
        $familia = Gos_Producto_Familia::find($gos_producto_familia_id);
        
        return Response::json($familia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Producto_Familia $gos_Producto_Familia            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gos_producto_familia_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Producto_Familia $gos_Producto_Familia            
     * @return \Illuminate\Http\Response
     */
    public function destroy($gos_producto_familia_id)
    {
        $familia = Gos_Producto_Familia::find($gos_producto_familia_id);
        $familia->delete();
        return Response::json($familia);
    }

    
    public static function cargaRapida(Request $request)
    {
        $familia = new Gos_Producto_Familia([
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_familia' => $request->name
        ]);
        
        $familia->save();
          
        $gos_producto_familia_id = $familia->gos_producto_familia_id;

        return $gos_producto_familia_id;
    }
}
