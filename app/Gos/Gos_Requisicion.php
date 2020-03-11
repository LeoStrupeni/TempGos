<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Requisicion extends Model
{
    protected $table = 'gos_requisicion';

    protected $primaryKey = 'gos_requisicion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
