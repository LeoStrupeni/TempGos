<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Vehiculos_Modelos_Marcas extends Model
{

    protected $table = 'gos_v_vehiculos_modelos_marcas';

    protected $primaryKey = 'gos_vehiculo_modelo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
