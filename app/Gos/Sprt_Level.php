<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Sprt_Level extends Model
{

    protected $table = 'sprt_level';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
