<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nomina extends Model
{

    protected $table = 'gos_nomina';

    protected $primaryKey = 'gos_nomina_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
