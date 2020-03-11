<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Mensajes extends Model
{

    protected $table = 'gos_v_mensajes';

    protected $primaryKey = 'gos_lic_mensaje_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}