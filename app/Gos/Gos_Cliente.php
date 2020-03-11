<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Cliente extends Model
{

    protected $table = 'gos_cliente';

    protected $primaryKey = 'gos_cliente_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
