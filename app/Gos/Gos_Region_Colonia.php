<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Region_Colonia extends Model
{

    protected $table = 'gos_region_colonia';

    protected $primaryKey = 'gos_region_colonia_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
