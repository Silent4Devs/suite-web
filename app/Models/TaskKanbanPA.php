<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskKanbanPA extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleados_task_kanban_p_a_s', 'task_kanban_p_a_s_id', 'empleados_id');
    }
}
