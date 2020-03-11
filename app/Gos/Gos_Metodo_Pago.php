<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Metodo_Pago extends Model
{

    protected $table = 'gos_metodo_pago';

    protected $primaryKey = 'gos_metodo_pago_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
