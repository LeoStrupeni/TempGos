<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Pres extends Model
{

    protected $table = 'gos_v_pres';

    protected $primaryKey = 'gos_v_pres_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
