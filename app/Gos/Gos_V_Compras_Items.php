<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Compras_Items extends Model
{
    protected $table = 'gos_v_compras_items';

    protected $primaryKey = 'gos_compra_item_id';

    protected $keyType = 'integer';

}