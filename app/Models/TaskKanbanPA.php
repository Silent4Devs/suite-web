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

    public function group()
    {
        return $this->belongsTo(GroupKanbanPA::class, 'group_kanban_p_a_s_id', 'id')->with('planAccion');
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciasTareasKanban::class, 'task_kanban_p_a_s_id', 'id');
    }
}
