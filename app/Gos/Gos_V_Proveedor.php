<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Proveedor extends Model
{
    protected $table = 'gos_v_proveedor';

    protected $primaryKey = 'gos_proveedor_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
