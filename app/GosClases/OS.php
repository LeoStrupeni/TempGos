<?php
namespace App\GosClases;

use GosClases\GosData;
use App\Gos\Gos_V_Os_;
use App\Gos\Gos_V_Paq_Etapas;
use App\Gos\Gos_V_Os_Items;
use App\Gos\Gos_V_Os_Etapas;
use Illuminate\Support\Facades\DB;

/**
 * Clase para manejar OS
 *
 * @author yois
 *        
 */
class OS extends GosData
{

    /**
     *
     * @param unknown $gos_os_id            
     * @return unknown
     */
    public static function obtenOSPorID($gos_os_id)
    {
        $datos = Gos_V_Os_::find($gos_os_id);
        return $datos;
    }

    /**
     *
     * @param unknown $gos_os_id            
     */
    public static function iniciaServicio($gos_os_id)
    {
        $cond = [
            [
                'gos_os_id',
                '=',
                $gos_os_id
            ]
        
        ];
        $etapaInicial = Gos_V_Os_Etapas::where($cond)->first();
        $gos_os_item_id = $etapaInicial->gos_os_item_id;
        if (isset($gos_os_item_id)) {
            self::activaEtapa($gos_os_item_id);
        }
    }

    /**
     * Activa una etapa
     *
     * @param unknown $param            
     */
    public static function activaEtapa($gos_os_item_id)
    {
        DB::statement('CALL gos_proc_activar_etapa(?)', [
            $gos_os_item_id
        ]);
    }

    /**
     * Agrega etapas de perdida total
     *
     * @param unknown $os_item_id            
     * @param unknown $os_item_id            
     */
    public static function preparaEtapasPerdidaTotal($os_item_id, $os_id)
{
    DB::statement('CALL gos_proc_agrega_perdida_total(?,?)', [
        $os_item_id,
        $os_id
    ]);
}

    /**
     * Agrega etapas de pago de danios
     *
     * @param unknown $os_item_id            
     * @param unknown $os_item_id            
     */
    public static function preparaEtapasPagoDanios($os_item_id, $os_id)
    {
        DB::statement('CALL gos_proc_agrega_pago_danio(?,?)', [
            $os_item_id,
            $os_id
        ]);
    }

    /**
     * Agrega etapas ligadas
     *
     * @param unknown $os_item_id            
     * @param unknown $os_item_id            
     */
    public static function preparaEtapasLigadas($os_item_id, $os_id)
    {
        DB::statement('CALL gos_proc_agrega_etapa_ligada(?,?)', [
            $os_item_id,
            $os_id
        ]);
    }
}
