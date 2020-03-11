<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Os_Encuesta extends Model
{
    protected $table = 'gos_os_encuesta';

    protected $primaryKey = 'gos_os_encuesta_id';

    
    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
