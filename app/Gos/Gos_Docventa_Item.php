<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Item extends Model
{
  protected $table = 'gos_docventa_item';

  protected $primaryKey = 'gos_docventa_item_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
