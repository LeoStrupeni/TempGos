<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Os_Producto_Interno_Externo extends Model
{

    protected $table = 'gos_v_os_producto_interno_externo';

    protected $primaryKey = 'gos_producto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
