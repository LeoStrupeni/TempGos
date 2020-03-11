<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Lic_Paq_Etapas extends Model
{

    protected $table = 'gos_v_lic_paq_etapas';

    protected $primaryKey = 'gos_taller_id';

    protected $keyType = 'integer';

    public $autoincrement = true; 
    
}
