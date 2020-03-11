<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Codigo_Sat extends Model
{
  protected $table = 'gos_docventa_codigo_sat';

  protected $primaryKey = 'gos_docventa_codigo_sat_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
