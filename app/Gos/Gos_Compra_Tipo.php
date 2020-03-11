<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Compra_Tipo extends Model
{
    protected $table = 'gos_compra_tipo';

    protected $primaryKey = 'gos_compra_tipo_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
