<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Requisicion_Item extends Model
{
    protected $table = 'gos_requisicion_item';

    protected $primaryKey = 'gos_requisicion_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
