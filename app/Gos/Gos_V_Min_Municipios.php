<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Municipios extends Model
{

    protected $table = 'gos_v_min_municipios';

    protected $primaryKey = 'gos_region_municipio_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
