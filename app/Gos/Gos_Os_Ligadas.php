<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Os_Ligadas extends Model
{
    protected $table = 'gos_os_ligadas';

    protected $primaryKey = 'gos_os_ligadas_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
