<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_Os_Mensajes extends Model
{

    protected $table = 'gos_os_mensaje';

    protected $primaryKey = 'gos_os_mensaje_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
    
    public $timestamps = false;
}
