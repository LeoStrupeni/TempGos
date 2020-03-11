<?php

namespace App\Gos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gos_OS extends Model
{
    use SoftDeletes;
    protected $table = 'gos_os';

    protected $primaryKey = 'gos_os_id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
