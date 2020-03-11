<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Vehiculo extends Model
{

    protected $table = 'gos_vehiculo';

    protected $primaryKey = 'gos_vehiculo_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
