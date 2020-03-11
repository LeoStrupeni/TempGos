<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Os_Refaccion_Comentarios extends Model
{
    protected $table = 'gos_os_refaccion_comentarios';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = true;

    public $guarded = [];
}
