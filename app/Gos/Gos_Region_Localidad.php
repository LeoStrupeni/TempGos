<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Region_Localidad extends Model
{

    protected $table = 'gos_region_localidad';

    protected $primaryKey = 'gos_region_localidad_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
