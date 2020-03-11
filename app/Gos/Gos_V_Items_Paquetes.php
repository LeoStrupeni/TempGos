<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Items_Paquetes extends Model
{

    protected $table = 'gos_v_items_paquetes';

    protected $primaryKey = 'gos_paquete_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true; 
    
}
