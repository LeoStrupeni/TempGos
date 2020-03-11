<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Segmenta_Comi extends Model
{
    protected $table = 'gos_usuario_segmenta_comi';

    protected $primaryKey = 'gos_usuario_seg_comision_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

}
