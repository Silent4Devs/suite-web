<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAccionKanban extends Model
{
    use HasFactory;

    protected $table = "planes_accion_kanban";
    protected $guarded = ['id'];

    public function groups()
    {
        return $this->hasMany(GroupKanbanPA::class, 'planes_accion_kanban_id', 'id')->with('tasks')->orderBy('order');
    }

    public function normas()
    {
        return $this->belongsToMany(Norma::class, 'normas_plan_accion_kanban', 'planes_accion_kanban_id', 'norma_id');
    }
}
