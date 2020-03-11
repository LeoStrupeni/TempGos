<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Medida extends Model
{

    protected $table = 'gos_producto_medida';

    protected $primaryKey = 'gos_producto_medida_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
