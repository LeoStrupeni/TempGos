<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Otros_Talleres extends Model
{

    protected $table = 'gos_v_otros_talleres';

    protected $primaryKey = 'gos_ot_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
