<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Os_Orden_Finalizadas extends Model
{

    protected $table = 'gos_os_orden_finalizadas';

    protected $primaryKey = 'gos_os_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}