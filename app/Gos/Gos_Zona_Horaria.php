<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Zona_Horaria extends Model
{

    protected $table = 'gos_zona_horaria';

    protected $primaryKey = 'gos_zona_horaria_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
