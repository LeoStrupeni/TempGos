<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Cliente_Factura extends Model
{

    protected $table = 'gos_cliente_factura';

    protected $primaryKey = 'relacion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
