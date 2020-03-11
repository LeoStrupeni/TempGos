<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Fac_Tipo_Persona extends Model
{

    protected $table = 'gos_fac_tipo_persona';

    protected $primaryKey = 'gos_fac_tipo_persona_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
