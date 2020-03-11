<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Docventa_Pago_Relacionado extends Model
{
  protected $table = 'gos_docventa_pago_relacionado';

  protected $primaryKey = 'gos_docventa_pago_rel_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
