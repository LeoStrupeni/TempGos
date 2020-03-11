<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Region_Estado extends Model
{

    protected $table = 'gos_region_estado';

    protected $primaryKey = 'gos_region_estado_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
