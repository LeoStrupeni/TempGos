<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Os_Items extends Model
{

    protected $table = 'gos_v_os_items';

    protected $primaryKey = 'gos_os_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
