<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Os_Mensajes extends Model
{

    protected $table = 'gos_v_os_mensajes';

    protected $primaryKey = 'gos_os_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
