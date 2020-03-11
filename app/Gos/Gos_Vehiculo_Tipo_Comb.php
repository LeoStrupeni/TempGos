<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Tipo_Comb extends Model
{
    protected $table = 'gos_vehiculo_tipo_comb';
    
    protected $primaryKey = 'gos_vehiculo_tipo_comb_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
