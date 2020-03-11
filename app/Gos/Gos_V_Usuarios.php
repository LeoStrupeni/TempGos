<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @author yois
 *
 */
class Gos_V_Usuarios extends Model
{

    use SoftDeletes;

    protected $table = 'gos_v_usuarios';

    protected $primaryKey = 'gos_usuario_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
