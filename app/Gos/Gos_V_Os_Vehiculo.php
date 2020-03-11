<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Os_Vehiculo extends Model
{
        protected $table = 'gos_v_os_vehiculo';
    
        protected $primaryKey = 'gos_os_id';
    
        protected $keyType = 'integer';

        public $autoincrement = true;
        
}
