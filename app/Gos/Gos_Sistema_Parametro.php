<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Sistema_Parametro extends Model
{
    protected $table = 'gos_sistema_parametro';
    
    protected $primaryKey = 'gos_sistema_parametro_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
