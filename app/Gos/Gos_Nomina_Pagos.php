<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nomina_Pagos extends Model
{
    protected $table = 'gos_nomina_pagos';

    protected $primaryKey = 'gos_nomina_pagos_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
