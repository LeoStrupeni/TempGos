<?php

namespace App\gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Seg_Comision extends Model
{
    protected $table = 'gos_usuario_seg_comision';

    protected $primaryKey = 'gos_usuario_seg_comision_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
