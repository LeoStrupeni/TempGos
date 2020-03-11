<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Os extends Model
{

    protected $table = 'gos_v_os';

    protected $primaryKey = 'gos_os_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
