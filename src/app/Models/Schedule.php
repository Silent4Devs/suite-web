<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

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
