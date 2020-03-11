<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Aseguradoras_ extends Model
{

    protected $table = 'gos_v_aseguradoras_';

    protected $primaryKey = 'gos_aseguradora_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
