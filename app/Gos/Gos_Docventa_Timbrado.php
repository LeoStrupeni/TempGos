<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Timbrado extends Model
{
  protected $table = 'gos_docventa_timbrado';

  protected $primaryKey = 'gos_docventa_timbrado_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
