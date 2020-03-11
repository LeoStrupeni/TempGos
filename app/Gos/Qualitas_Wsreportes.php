<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Qualitas_Wsreportes extends Model
{

    protected $table = 'qualitas_wsreportes';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
