<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Externo_Entregados extends Model
{
    protected $table = 'gos_producto_externo_entregados';

    protected $primaryKey = 'gos_producto_externo_entregados_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
