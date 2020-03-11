<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *        
 */
class Gos_Vehiculo_Inventario_Doc extends Model
{
    protected $table = 'gos_vehiculo_inventario_doc';

    protected $primaryKey = 'gos_vehiculo_inventario_doc_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
