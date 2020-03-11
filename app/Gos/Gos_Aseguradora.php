<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Aseguradora extends Model
{

    protected $table = 'gos_aseguradora';

    protected $primaryKey = 'gos_aseguradora_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
