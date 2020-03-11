<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Taller_Conf_vehiculo extends Model
{
  protected $table = 'gos_taller_conf_vehiculo';

  protected $primaryKey = 'gos_taller_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
