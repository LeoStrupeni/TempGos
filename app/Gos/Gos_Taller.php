<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Taller extends Model
{

    protected $table = 'gos_taller';

    protected $primaryKey = 'gos_taller_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
