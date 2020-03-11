<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Marca extends Model
{

    protected $table = 'gos_producto_marca';

    protected $primaryKey = 'gos_producto_marca_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
