<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Clientes_ extends Model
{

    protected $table = 'gos_v_clientes_';

    protected $primaryKey = 'gos_cliente_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
