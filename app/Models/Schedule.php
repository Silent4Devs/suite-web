<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $casts = [
        'organizacions_id' => 'int',

    ];

    protected $fillable = [
        'working_day',
        'start_work_time',
        'end_work_time',
        'organizacions_id',

    ];

    public function organizacion()
    {
        return $this->hasMany('App\Model\Organizacion');
    }
}
