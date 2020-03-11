<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Clientes extends Model
{
    protected $table = 'gos_v_min_clientes';
    
    protected $primaryKey = 'gos_cliente_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
}
