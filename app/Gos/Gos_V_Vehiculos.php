<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Vehiculos extends Model
{

    protected $table = 'gos_v_vehiculos';

    protected $primaryKey = 'gos_vehiculo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
