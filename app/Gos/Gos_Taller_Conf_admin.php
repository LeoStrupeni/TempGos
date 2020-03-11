<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Taller_Conf_admin extends Model
{
  protected $table = 'gos_taller_conf_admin';

  protected $primaryKey = 'gos_taller_id';

  protected $keyType = 'integer';

  public $autoincrement = true;

  public $timestamps = false;

  public $guarded = [];
}
