<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paquete_Item extends Model
{
    protected $table = 'gos_paquete_item';

    protected $primaryKey = 'gos_paquete_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
