<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Cancelada extends Model
{
  protected $table = 'gos_docventa_cancelada';

  protected $primaryKey = 'gos_docventa_cancelada_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
