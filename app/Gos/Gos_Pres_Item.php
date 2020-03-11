<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Pres_Item extends Model
{

    protected $table = 'gos_pres_item';

    protected $primaryKey = 'gos_pres_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
