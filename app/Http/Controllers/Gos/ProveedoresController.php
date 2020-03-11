<?php
namespace App\Http\Controllers\Gos;

use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;
use App\Gos\Gos_Proveedor;
use App\Gos\Gos_V_Proveedor;
use App\Gos\Gos_V_Min_Proveedores;
use App\Gos\Gos_V_Compras_Proveedor;
use App\Gos\Gos_Metodo_Pago;

/**
 *
 * @author yois
 *        
 */
class ProveedoresController extends GosControllers
{
    
    protected $vistaListado = 'Proveedores/ListarProveedores';

    protected $opcionesEditDataTable = 'Proveedores.OpcionesProveedoresDatatable';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * preparar ajax
         */
        //
        $ajax = $this->preparaDataTableAjax($this->listadoGeneral(), $this->getOpcionesEditDataTable());
        if (null !== $ajax) {
            return $ajax;
        }
        
        $listaMetodosPagos = Gos_Metodo_Pago::all();

        return view($this->getVistaListado(),compact('listaMetodosPagos'));
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listadoGeneral($criterio = '')
    {
        return Gos_V_Proveedor::where(self::condIdTaller())->get();
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
     *
     * @param Request $request            
     * @return string
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
        return Response::json($this->preparaDatos($request));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\Gos\GosControllers::preparaDatos()
     */
    protected function preparaDatos($request)
    {
        $proveedor = null;
        $gos_proveedor_id = isset($request->gos_proveedor_id) ? $request->gos_proveedor_id : 0;

        $datos = $this->datosEntidad($request);

        if ($gos_proveedor_id > 0) {
            Gos_Proveedor::find($gos_proveedor_id)->update($datos);
        } else {
            $proveedor = new Gos_Proveedor($datos);
            $proveedor->save();
            $gos_proveedor_id = $proveedor->gos_proveedor_id;
        }
        //
        $this->setEntidad_id($gos_proveedor_id);

        return $proveedor;
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
            'nomb_proveedor' => $request->nomb_proveedor,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'email' => $request->email
            //'saldo_pdte' => $request->saldo_pdte
        ];
    }

    /**
     * Metodo usado para mostrar las compras de un proveedor, falta revisar vista de base de datos
     *
     * @param \App\Gos\Gos_Proveedor $gos_Proveedor            
     * @return \Illuminate\Http\Response
     */
    public function show($gos_proveedor_id)
    {
        $listado = Gos_V_Compras_Proveedor::where(self::condIdTaller())
                                ->where('gos_proveedor_id',$gos_proveedor_id)
                                ->get();
        
        $opciones = 'Proveedores.OpcionesComprasProveedor';    

        $ajax = $this->preparaDataTableAjax($listado, $opciones);

        return $ajax;
        
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param Integer $gos_proveedor_id            
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($gos_proveedor_id)
    {
        $proveedor = Gos_Proveedor::find($gos_proveedor_id);
        return Response::json($proveedor);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Proveedor $gos_Proveedor            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Proveedor $gos_Proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer $gos_proveedor_id            
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($gos_proveedor_id)
    {
        $proveedor = Gos_Proveedor::find($gos_proveedor_id);
        $proveedor->delete();
        return Response::json($proveedor);
    }

    /**
     *
     * @return unknown
     */
    public static function listaMiniProveedors()
    {
        // Traer informacion de clase modelo
        return Gos_V_Min_Proveedores::where(self::condIdTaller())->get();
    }

    public static function cargaRapida(Request $request)
    {
        $proveedor = new Gos_Proveedor([
            'gos_taller_id' => self::tallerIdActual(),
            'nomb_proveedor' => $request->nomb_proveedor,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'email' => $request->email
        ]);
        
        $proveedor->save();

        $gos_proveedor_id = $proveedor->gos_proveedor_id;

        return $gos_proveedor_id;
    }

}
