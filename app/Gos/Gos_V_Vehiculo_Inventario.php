<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Vehiculo_Inventario extends Model
{

    protected $table = 'gos_v_vehiculo_inventario';

    protected $primaryKey = 'gos_vehiculo_inventario_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
