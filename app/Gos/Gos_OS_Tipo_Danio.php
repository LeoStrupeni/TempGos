<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Tipo_Danio extends Model
{
    protected $table = 'gos_os_tipo_danio';
    
    protected $primaryKey = 'gos_os_tipo_danio_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
