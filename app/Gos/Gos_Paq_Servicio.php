<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Servicio extends Model
{
    protected $table = 'gos_paq_servicio';
    
    protected $primaryKey = 'gos_paq_servicio_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
