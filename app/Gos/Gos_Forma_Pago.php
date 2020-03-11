<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Forma_Pago extends Model
{
    protected $table = 'gos_forma_pago';

    protected $primaryKey = 'gos_forma_pago_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
