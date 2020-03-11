<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Ot extends Model
{

    protected $table = 'gos_ot';

    protected $primaryKey = 'gos_ot_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
