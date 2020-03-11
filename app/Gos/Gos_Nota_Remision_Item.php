<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nota_Remision_Item extends Model
{

    protected $table = 'gos_nota_remision_item';

    protected $primaryKey = 'gos_nota_remision_item_id';

    protected $keyType = 'integer';

    
    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
