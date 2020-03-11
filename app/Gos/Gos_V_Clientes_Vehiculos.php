<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Clientes_Vehiculos extends Model
{
    protected $table = 'gos_v_clientes_vehiculos';
    
    protected $primaryKey = 'gos_vehiculo_id';
    
    protected $keyType = 'integer';
}
