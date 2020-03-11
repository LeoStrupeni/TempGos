<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Pres_Servicio extends Model
{

    protected $table = 'gos_pres_servicio';

    protected $primaryKey = 'gos_pres_servicio_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
