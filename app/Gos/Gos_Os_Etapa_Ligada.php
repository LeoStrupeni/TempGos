<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Os_Etapa_Ligada extends Model
{

    protected $table = 'gos_os_etapa_ligada';

    protected $primaryKey = 'gos_os_etapa_ligada_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
