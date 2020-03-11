<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Compra_Item extends Model
{

    protected $table = 'gos_compra_item';

    protected $primaryKey = 'gos_compra_item_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
