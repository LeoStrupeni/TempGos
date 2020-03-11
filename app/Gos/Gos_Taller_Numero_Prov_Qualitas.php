<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Taller_Numero_Prov_Qualitas extends Model
{

    protected $table = 'gos_taller_numero_prov_qualitas';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
