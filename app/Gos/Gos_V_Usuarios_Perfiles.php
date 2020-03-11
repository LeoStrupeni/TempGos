<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_V_Usuarios_Perfiles extends Model
{
    protected $table = 'gos_v_usuarios_perfiles';
    
    protected $primaryKey = 'gos_usuario_perfil_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
}
