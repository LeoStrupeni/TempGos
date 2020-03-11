<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Paq_Etapas extends Model
{

    protected $table = 'gos_v_paq_etapas';

    protected $primaryKey = 'gos_paq_etapa_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
