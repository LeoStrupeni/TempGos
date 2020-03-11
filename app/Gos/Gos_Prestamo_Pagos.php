<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Prestamo_Pagos extends Model
{
    protected $table = 'gos_prestamo_pagos';

    protected $primaryKey = 'gos_prestamo_pagos_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
