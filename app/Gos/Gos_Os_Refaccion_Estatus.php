<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Refaccion_Estatus extends Model
{
    protected $table = 'gos_os_refaccion_estatus';

    protected $primaryKey = 'gos_os_refaccion_estatus_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = []; 
}
