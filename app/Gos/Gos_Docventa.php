<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa extends Model
{
  protected $table = 'gos_docventa';

  protected $primaryKey = 'gos_docventa_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
