<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Etapa_Asesor extends Model
{
    protected $table = 'gos_etapa_asesor';
    
    protected $primaryKey = 'gos_etapa_asesor_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
