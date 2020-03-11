<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Aseguradoras extends Model
{
    protected $table = 'gos_v_min_aseguradoras';
    
    protected $primaryKey = 'gos_aseguradora_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
}
