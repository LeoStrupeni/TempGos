<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto_Ubic_Stock extends Model
{

    protected $table = 'gos_producto_ubic_stock';

    protected $primaryKey = 'gos_producto_ubic_stock_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
