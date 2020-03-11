<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Lic_Taller_Usuario extends Model
{

    protected $table = 'gos_lic_taller_usuario';

    protected $primaryKey = 'gos_lic_taller_usuario_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
