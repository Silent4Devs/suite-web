<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyecto extends Model
{
    use HasFactory;

    protected $table = 'timesheet_proyectos';

    protected $fillable = [
        'proyecto',
    ];
}
