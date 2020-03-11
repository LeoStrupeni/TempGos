<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Externo extends Model
{
    protected $table = 'gos_producto_externo';

    protected $primaryKey = 'gos_producto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
