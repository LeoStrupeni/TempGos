<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Refaccion extends Model
{
    protected $table = 'gos_os_refaccion';

    protected $primaryKey = 'gos_os_refaccion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = []; 
}
