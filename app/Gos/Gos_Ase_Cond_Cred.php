<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Ase_Cond_Cred extends Model
{

    protected $table = 'gos_ase_cond_cred';

    protected $primaryKey = 'relacion_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
