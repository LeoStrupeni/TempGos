<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_Taller_Horas_Habil extends Model
{

    protected $table = 'gos_taller_horas_habil';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
