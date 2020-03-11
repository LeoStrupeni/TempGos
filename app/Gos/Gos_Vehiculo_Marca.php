<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Vehiculo_Marca extends Model
{

    protected $table = 'gos_vehiculo_marca';

    protected $primaryKey = 'gos_vehiculo_marca_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
