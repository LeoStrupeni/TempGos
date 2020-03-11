<?php

namespace App\gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Tecnico extends Model
{
    protected $table = 'gos_usuario_tecnico';

    protected $primaryKey = 'gos_usuario_tecnico_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
