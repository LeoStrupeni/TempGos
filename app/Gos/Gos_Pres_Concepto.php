<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Pres_Concepto extends Model
{

    protected $table = 'gos_pres_concepto';

    protected $primaryKey = 'gos_pres_concepto_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
