<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetTarea extends Model
{
    use HasFactory;

    protected $table = 'timesheet_tareas';

    protected $fillable = [
        'tarea',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }
}
