<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Producto extends Model
{

    protected $table = 'gos_producto';

    protected $primaryKey = 'gos_producto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
