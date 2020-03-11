<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @author yois
 *
 */
class Gos_Usuario_Perfil extends Model
{


    protected $table = 'gos_usuario_perfil';

    protected $primaryKey = 'gos_usuario_perfil_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
