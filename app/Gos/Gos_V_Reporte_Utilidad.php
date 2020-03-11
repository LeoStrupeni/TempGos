<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Reporte_Utilidad extends Model
{
    protected $table = 'gos_v_reporte_utilidad';

    public function scopeFilterAseguradora($query, $aseguradora)
    {
        if (!is_null($aseguradora)) {
            return $query->where('aseguradora', $aseguradora);
        }
    }

    public function scopeFilterTipoOrden($query, $tipoOrden)
    {
        if (!is_null($tipoOrden)) {
            return $query->where('tipo_orden', $tipoOrden);
        }
    }

    public function scopeFilterItem($query, $item)
    {
        if (!is_null($item)) {
            return $query->where('item', $item);
        }
    }

    public function scopeFilterGlobal($query, $global)
    {
        if (!is_null($global)) {
            $variable = "'%".$global."%'";

            $consulta = "(nomb_cliente like $variable or aseguradora like $variable or tipo_orden like $variable or gos_os_id like $variable or nro_orden_interno like $variable or fechaCreacion like $variable or nomb_cliente like $variable or detallesVehiculo like $variable or nomb_aseguradora_min like $variable or TOTAL like $variable or INVENTARIO like $variable or MANOOBRA like $variable or EXTERNOS like $variable or EGRESOS like $variable or UTILIDAD like $variable)";

            return $query->whereRaw($consulta);
                        
        }
    }


}
