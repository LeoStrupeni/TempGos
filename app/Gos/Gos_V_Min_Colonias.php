<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Colonias extends Model
{

    protected $table = 'gos_v_min_colonias';

    protected $primaryKey = 'gos_region_colonia_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
