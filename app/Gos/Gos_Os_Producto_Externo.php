<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Os_Producto_Externo extends Model
{
    protected $table = 'gos_os_producto_externo';

    protected $primaryKey = 'gos_os_producto_externo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = []; 
}
