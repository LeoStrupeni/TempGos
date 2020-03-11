<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Ase_Fac extends Model
{

    protected $table = 'gos_ase_fac';

    protected $primaryKey = 'relacion_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
