<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Etapa_Mensaje extends Model
{
    protected $table = 'gos_paq_etapa_mensaje';
    
    protected $primaryKey = 'gos_paq_etapa_mensaje_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
