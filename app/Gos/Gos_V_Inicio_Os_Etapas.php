<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Inicio_Os_Etapas extends Model
{

    protected $table = 'gos_v_inicio_os_etapas';

    protected $primaryKey = 'gos_taller_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
