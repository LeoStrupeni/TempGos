<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Prestamo extends Model
{
    protected $table = 'gos_prestamo';

    protected $primaryKey = 'gos_prestamo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
