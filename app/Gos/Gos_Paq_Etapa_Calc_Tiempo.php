<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Etapa_Calc_Tiempo extends Model
{
    protected $table = 'gos_paq_etapa_calc_tiempo';
    
    protected $primaryKey = 'gos_paq_etapa_calc_tiempo_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
