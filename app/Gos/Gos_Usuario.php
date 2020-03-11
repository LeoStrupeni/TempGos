<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @author yois
 *
 */
class Gos_Usuario extends Model
{
      use SoftDeletes;
      
    protected $table = 'gos_usuario';

    protected $primaryKey = 'gos_usuario_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
