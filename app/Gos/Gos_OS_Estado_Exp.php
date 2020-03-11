<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Estado_Exp extends Model
{
    protected $table = 'gos_os_estado_exp';
    
    protected $primaryKey = 'gos_os_estado_exp_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
