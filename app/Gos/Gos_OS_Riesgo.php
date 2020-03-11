<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Riesgo extends Model
{
    protected $table = 'gos_os_riesgo';
    
    protected $primaryKey = 'gos_os_riesgo_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
