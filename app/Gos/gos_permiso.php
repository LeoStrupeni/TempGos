<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Permiso extends Model
{

    protected $table = 'gos_permiso';

    protected $primaryKey = 'gos_permiso_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}