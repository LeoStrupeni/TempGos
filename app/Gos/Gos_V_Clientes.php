<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Clientes extends Model
{

    protected $table = 'gos_v_clientes';

    protected $primaryKey = 'gos_cliente_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
