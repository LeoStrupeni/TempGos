<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Proveedor extends Model
{

    protected $table = 'gos_proveedor';

    protected $primaryKey = 'gos_proveedor_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}