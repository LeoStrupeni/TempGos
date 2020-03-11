<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Etapa_Perdida_Total extends Model
{
    protected $table = 'gos_paq_etapa_perdida_total';
    
    protected $primaryKey = 'gos_paq_etapa_perdida_total_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
