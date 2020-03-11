<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Permiso_Item extends Model
{

    protected $table = 'gos_permiso_item';

    protected $primaryKey = 'gos_permiso_item_id';

    protected $keyType = 'integer';

    public $timestamps = false;

    public $guarded = [];
}
