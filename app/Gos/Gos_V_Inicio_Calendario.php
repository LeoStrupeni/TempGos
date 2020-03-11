<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Inicio_Calendario extends Model
{

    protected $table = 'gos_v_inicio_calendario';

    protected $primaryKey = 'gos_os_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

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

    public function scopeFilterFechaCreacion($query, $fecha,$fechaMax)
    {
        if (!is_null($fecha)) {
            return $query->whereBetween('fecha_creacion_os',[$fecha,$fechaMax]);
        }
    }

    public function scopeFilterFechaIngreso($query, $fecha,$fechaMax)
    {
        if (!is_null($fecha)) {
            return $query->whereBetween('fecha_ingreso_v_os',[$fecha,$fechaMax]);
        }
    }

    public function scopeFilterFechaTerminado($query, $fecha,$fechaMax)
    {
        if (!is_null($fecha)) {
            return $query->whereBetween('fecha_terminado',[$fecha,$fechaMax]);
        }
    }

    public function scopeFilterFechaEntregado($query, $fecha,$fechaMax)
    {
        if (!is_null($fecha)) {
            return $query->whereBetween('fecha_entregado',[$fecha,$fechaMax]);
        }
    }

    public function scopeFilterFechaFacturado($query, $fecha,$fechaMax)
    {
        if (!is_null($fecha)) {
            return $query->whereBetween('fecha_facturado',[$fecha,$fechaMax]);
        }
    }

    public function scopeFilterFechaRemision($query, $fecha)
    {
        if (!is_null($fecha)) {
            return $query->where('fecha_nota',$fecha);
        }
    }


}
