<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Tecnico_Servicios_Asoc extends Model
{
    protected $table = 'gos_usuario_tecnico_servicios_asoc';

    protected $primaryKey = 'gos_usuario_tecnico_servicios_asoc_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
