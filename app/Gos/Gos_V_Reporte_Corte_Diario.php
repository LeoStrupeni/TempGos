<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_V_Reporte_Corte_Diario extends Model
{
    protected $table = 'gos_v_reporte_corte_diario';

    public function scopeFilterType($query, $filter_type)
    {
        if (!is_null($filter_type)) {
            return $query->where('estado','like','%'.$filter_type.'%');
        }
    }

}
