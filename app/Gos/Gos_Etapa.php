<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Etapa extends Model
{

    protected $table = 'gos_etapa';

    protected $primaryKey = 'gos_etapa_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
