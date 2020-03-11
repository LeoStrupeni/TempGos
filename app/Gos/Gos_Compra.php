<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Compra extends Model
{
  protected $table = 'gos_compra';

  protected $primaryKey = 'gos_compra_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
