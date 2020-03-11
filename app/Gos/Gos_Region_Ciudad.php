<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Region_Ciudad extends Model
{

    protected $table = 'gos_region_ciudad';

    protected $primaryKey = 'gos_region_ciudad_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
