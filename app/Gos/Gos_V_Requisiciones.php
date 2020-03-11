<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Requisiciones extends Model
{
    protected $table = 'gos_v_requisiciones';

    protected $primaryKey = 'gos_requisicion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

}
