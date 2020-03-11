<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Parte extends Model
{
    protected $table = 'gos_vehiculo_parte';
    
    protected $primaryKey = 'gos_vehiculo_parte_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    //public $guarded = [];
}
