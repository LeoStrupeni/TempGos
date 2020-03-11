<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Medidor_Gas extends Model
{
    //gos_veihiculo_medidor_gas
    protected $table = 'gos_vehiculo_medidor_gas';
    
    protected $primaryKey = 'gos_vehiculo_medidor_gas_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;

    //public $guarded = [];
}
