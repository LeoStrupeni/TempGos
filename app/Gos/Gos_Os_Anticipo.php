<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_OS_Anticipo extends Model
{
    protected $table = 'gos_os_anticipo';
    
    protected $primaryKey = 'gos_os_anticipo_id';
    
    protected $keyType = 'integer';
    
    public $autoincrement = true;
    
    public $timestamps = false;
    
    public $guarded = [];
}
