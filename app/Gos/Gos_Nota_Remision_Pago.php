<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nota_Remision_Pago extends Model
{

    protected $table = 'gos_nota_remision_pago';

    protected $primaryKey = 'gos_nota_remision_pago_id';

    protected $keyType = 'integer';

    
    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
