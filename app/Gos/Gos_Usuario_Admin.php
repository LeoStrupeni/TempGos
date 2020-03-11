<?php

namespace App\gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Admin extends Model
{
    protected $table = 'gos_usuario_admin';

    protected $primaryKey = 'gos_usuario_admin_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
