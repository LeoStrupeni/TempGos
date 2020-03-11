<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Ubicaciones_Stock extends Model
{

    protected $table = 'gos_v_ubicaciones_stock';

    protected $primaryKey = 'gos_producto_ubic_stock_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
