<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;
use Monolog\Handler\FallbackGroupHandler;

class Gos_Color extends Model
{

    protected $table = 'gos_color';

    protected $primaryKey = 'codigohex';

    protected $keyType = 'string';

    public $autoincrement = false;

    public $timestamps = false;

    public $guarded = [];
}
