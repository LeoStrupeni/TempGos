<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Cliente_Cond_Credito extends Model
{

    protected $table = 'gos_cliente_cond_credito';

    protected $primaryKey = 'relacion_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
