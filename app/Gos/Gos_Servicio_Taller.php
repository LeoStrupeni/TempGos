<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Servicio_Taller extends Model
{
    protected $table = 'gos_servicio_taller';
    
    protected $primaryKey = 'gos_sistema_parametro_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
