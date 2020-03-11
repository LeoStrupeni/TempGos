<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Min_Proveedores extends Model
{

    protected $table = 'gos_v_min_proveedores';

    protected $primaryKey = 'gos_proveedor_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
}
