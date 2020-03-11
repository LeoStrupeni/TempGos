<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Os_Item extends Model
{

    protected $table = 'gos_os_item';

    protected $primaryKey = 'gos_os_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
