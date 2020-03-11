<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_Taller_Tipo extends Model
{

    protected $table = 'gos_taller_tipo';

    protected $primaryKey = 'taller_tipoid';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
