<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Ubicacion extends Model
{

    protected $table = 'gos_producto_ubicacion';

    protected $primaryKey = 'gos_producto_ubicacion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
