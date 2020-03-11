<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Sprt_Message extends Model
{

    protected $table = 'sprt_message';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
