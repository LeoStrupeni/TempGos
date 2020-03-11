<?php
namespace App\Http\Controllers\Gos;

use App\Gos\Gos_Sistema_Parametro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 *
 * @author yois
 *        
 */
class GosSistemaParametrosController extends Controller
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
     * @param \App\Gos\Gos_Sistema_Parametro $gos_Sistema_Parametro            
     * @return \Illuminate\Http\Response
     */
    public function show(Gos_Sistema_Parametro $gos_Sistema_Parametro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gos\Gos_Sistema_Parametro $gos_Sistema_Parametro            
     * @return \Illuminate\Http\Response
     */
    public function edit(Gos_Sistema_Parametro $gos_Sistema_Parametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \App\Gos\Gos_Sistema_Parametro $gos_Sistema_Parametro            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gos_Sistema_Parametro $gos_Sistema_Parametro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gos\Gos_Sistema_Parametro $gos_Sistema_Parametro            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gos_Sistema_Parametro $gos_Sistema_Parametro)
    {
        //
    }

    /**
     * deveulve el valor entero de un parametro
     *
     * @param unknown $nomb_parametro            
     * @return number
     */
    public static function valorEntero($nomb_parametro)
    {
        /**
         *
         * @var unknown $p
         */
        $p = Gos_Sistema_Parametro::where('parametro', $nomb_parametro)->first();
        if (isset($p->valor_entero))
            return $p->valor_entero;
        else
            return 0;
    }

    /**
     * devuelve un parametro de texto
     *
     * @param string $nomb_parametro            
     * @return string
     */
    public static function valorTexto($nomb_parametro)
    {
        /**
         *
         * @var unknown $p
         */
        $p = Gos_Sistema_Parametro::where('parametro', $nomb_parametro)->first();
        if (isset($p->valor_texto))
            return $p->valor_texto;
        else
            return '';
    }
}
