<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupKanbanPA extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function tasks()
    {
        return $this->hasMany(TaskKanbanPA::class, 'group_kanban_p_a_s_id', 'id')->orderBy('order');
    }
}
