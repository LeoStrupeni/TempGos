<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Usuario_Admin_Comision extends Model
{
    protected $table = 'gos_usuario_admin_comision';

    protected $primaryKey = 'gos_usuario_admin_comision_id';

    protected $keyType = '';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
