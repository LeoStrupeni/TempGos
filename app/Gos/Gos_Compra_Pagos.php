<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Compra_Pagos extends Model
{
    protected $table = 'gos_compra_pagos';

    protected $primaryKey = 'gos_compra_pagos_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
