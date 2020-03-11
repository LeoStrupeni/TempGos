<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Familia extends Model
{

    protected $table = 'gos_producto_familia';

    protected $primaryKey = 'gos_producto_familia_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
