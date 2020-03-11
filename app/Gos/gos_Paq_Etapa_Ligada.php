<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Paq_Etapa_Ligada extends Model
{
    protected $table = 'gos_paq_etapa_ligada';

    protected $primaryKey = 'gos_paq_etapa_ligada_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
