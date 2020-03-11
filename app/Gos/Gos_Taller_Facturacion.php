<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @author yois
 *
 */
class Gos_Taller_Facturacion extends Model
{

    protected $table = 'gos_taller_facturacion';

    protected $primaryKey = 'gos_taller_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
