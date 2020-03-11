<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Os_Etapa_Perdida_Total extends Model
{

    protected $table = 'gos_os_etapa_perdida_total';

    protected $primaryKey = 'gos_os_etapa_perdida_total_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
