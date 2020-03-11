<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Nota_Remision extends Model
{

    protected $table = 'gos_nota_remision';

    protected $primaryKey = 'gos_nota_remision_id';

    protected $keyType = 'integer';

    public $autoincrement = true;
    

    public $timestamps = false;

    public $guarded = [];
}
