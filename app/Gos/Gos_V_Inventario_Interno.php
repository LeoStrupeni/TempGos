<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Inventario_Interno extends Model
{

    protected $table = 'gos_v_inventario_interno';

    protected $primaryKey = 'gos_producto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
