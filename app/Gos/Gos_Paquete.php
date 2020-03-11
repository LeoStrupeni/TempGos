<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paquete extends Model
{
    protected $table = 'gos_paquete';

    protected $primaryKey = 'gos_paquete_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
