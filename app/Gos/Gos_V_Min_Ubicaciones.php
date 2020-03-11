<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Ubicaciones extends Model
{

    protected $table = 'gos_v_min_ubicaciones';

    protected $primaryKey = 'gos_producto_ubicacion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
