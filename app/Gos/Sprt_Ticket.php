<?php
namespace App\Gos;

use Illuminate\Database\Eloquent\Model;

class Sprt_Ticket extends Model
{

    protected $table = 'sprt_ticket';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public $autoincrement = true;

    public $timestamps = false;

    public $guarded = [];
}
