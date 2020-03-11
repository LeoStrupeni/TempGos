<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Paq_Servicios extends Model
{

    protected $table = 'gos_v_paq_servicios';

    protected $primaryKey = 'gos_paq_servicio_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
