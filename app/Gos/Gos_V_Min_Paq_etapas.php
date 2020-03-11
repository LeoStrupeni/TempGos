<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Paq_etapas extends Model
{

    protected $table = 'gos_v_min_paq_etapas';

    protected $primaryKey = 'gos_paq_etapa_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
