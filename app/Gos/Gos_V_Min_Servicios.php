<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Servicios extends Model
{

    protected $table = 'gos_v_min_servicios';

    protected $primaryKey = 'gos_paq_servicio_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
