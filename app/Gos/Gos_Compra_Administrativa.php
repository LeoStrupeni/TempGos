<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Compra_Administrativa extends Model
{

    protected $table = 'gos_compra_administrativa';

    protected $primaryKey = 'gos_compra_administrativa_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
