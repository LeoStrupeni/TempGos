<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Qualitas_Repositorio_Archivos extends Model
{
    protected $table = 'qualitas_repositorio_archivos';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
