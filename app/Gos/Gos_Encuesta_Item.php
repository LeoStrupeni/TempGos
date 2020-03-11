<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Encuesta_Item extends Model
{

    protected $table = 'gos_encuesta_item';

    protected $primaryKey = 'gos_encuesta_item_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
