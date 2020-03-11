<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Encuestas extends Model
{

    protected $table = 'gos_v_encuestas';

    protected $primaryKey = 'gos_encuesta_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
