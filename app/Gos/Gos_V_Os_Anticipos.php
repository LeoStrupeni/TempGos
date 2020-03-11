<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Os_Anticipos extends Model
{

    protected $table = 'gos_v_os_anticipos';

    protected $primaryKey = 'gos_os_anticipo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
