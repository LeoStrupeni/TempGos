<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Encuesta extends Model
{

    protected $table = 'gos_encuesta';

    protected $primaryKey = 'gos_encuesta_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
