<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_Taller_Horarios extends Model
{

    protected $table = 'gos_taller_horarios';

    protected $primaryKey = 'gos_taller_horarios_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
