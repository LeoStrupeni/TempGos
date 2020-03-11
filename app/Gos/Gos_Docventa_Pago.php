<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Pago extends Model
{
  protected $table = 'gos_docventa_pago';

  protected $primaryKey = 'gos_docventapago_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
