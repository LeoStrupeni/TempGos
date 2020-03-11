<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Inicio_Creadas extends Model
{

    protected $table = 'gos_v_inicio_creadas';

    protected $primaryKey = 'gos_taller_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
