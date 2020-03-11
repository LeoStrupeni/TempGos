<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_V_Reporte_Orden_Servicio extends Model
{

    protected $table = 'gos_v_reporte_orden_servicio';

    public function scopeFilterAseguradora($query, $aseguradora)
    {
        if (!is_null($aseguradora)) {
            return $query->where('gos_aseguradora_id', $aseguradora);
        }
    }

    public function scopeFilterTipoDanio($query, $danio)
    {
        if (!is_null($danio)) {
            return $query->where('gos_os_tipo_danio_id', $danio);
        }
    }

    public function scopeFilterTipoOrden($query, $orden)
    {
        if (!is_null($orden)) {
            return $query->where('gos_os_tipo_o_id', $orden);
        }
    }

    public function scopeFilterEstado($query, $estado)
    {
        if (!is_null($estado)) {
            return $query->where('gos_os_estado_exp_id', $estado);
        }
    }

}
