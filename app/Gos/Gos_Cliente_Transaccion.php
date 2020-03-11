<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Cliente_Transaccion extends Model
{

    protected $table = 'gos_cliente_transaccion';

    protected $primaryKey = 'gos_cliente_transaccion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
