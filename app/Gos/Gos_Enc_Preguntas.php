<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Enc_Preguntas extends Model
{

    protected $table = 'gos_enc_preguntas';

    protected $primaryKey = 'gos_enc_preguntas_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
