<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Presupuesto_Concepto extends Model
{

    protected $table = 'gos_v_min_presupuesto_concepto';

    protected $primaryKey = 'gos_pres_concepto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}

