<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Nro_Puertas extends Model
{

    protected $table = 'gos_vehiculo_nro_puertas';

    protected $primaryKey = 'nro_puertas';

    protected $keyType = 'integer';

    public $autoincrement = false;

    public $timestamps = false;

    public $guarded = [];
}
