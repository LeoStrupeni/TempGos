<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Inventario_Externo extends Model
{
    protected $table = 'gos_v_inventario_externo';

    protected $primaryKey = 'gos_producto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
