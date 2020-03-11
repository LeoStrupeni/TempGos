<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Vehiculo_Modelo extends Model
{

    protected $table = 'gos_vehiculo_modelo';

    protected $primaryKey = 'gos_vehiculo_modelo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
