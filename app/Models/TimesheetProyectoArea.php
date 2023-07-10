<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyectoArea extends Model
{
    use HasFactory;

    protected $table = 'timesheet_proyectos_areas';

    protected $fillable = [
        'area_id',
        'proyecto_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
