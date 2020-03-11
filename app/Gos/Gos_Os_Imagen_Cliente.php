<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Gos_Os_Imagen_Cliente extends Model
{
    protected $table = 'gos_os_imagen_cliente';

    protected $primaryKey = 'gos_os_imagen_cliente_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
