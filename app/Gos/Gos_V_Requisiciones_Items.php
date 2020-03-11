<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Requisiciones_Items extends Model
{
    protected $table = 'gos_v_requisiciones_items';

    protected $primaryKey = 'gos_requisicion_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
