<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Region_Municipio extends Model
{

    protected $table = 'gos_region_municipio';

    protected $primaryKey = 'gos_region_municipio_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
