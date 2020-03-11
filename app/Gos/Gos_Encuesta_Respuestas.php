<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Encuesta_Respuestas extends Model
{

    protected $table = 'gos_encuesta_respuestas';

    protected $primaryKey = 'gos_encuesta_respuestas_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
