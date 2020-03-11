<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Cilindro extends Model
{
    protected $table = 'gos_vehiculo_cilindro';
    
    protected $primaryKey = 'vehiculo_cilindros';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
