<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_V_Marcas_ extends Model
{

    protected $table = 'gos_v_marcas_';

    protected $primaryKey = 'gos_vehiculo_marca_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
