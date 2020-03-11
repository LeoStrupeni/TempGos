<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nomina_Item extends Model
{

    protected $table = 'gos_nomina_item';

    protected $primaryKey = 'gos_nomina_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
