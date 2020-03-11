<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Etapa_Pago_Danios extends Model
{
    protected $table = 'gos_paq_etapa_pago_danios';
    
    protected $primaryKey = 'gos_paq_etapar_pago_danios_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
