<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciasTareasKanban extends Model
{
    use HasFactory;
    protected $table = 'evidencias_tareas_kanban';
    protected $guarded = ['id'];

    protected $appends = ['archivo_ruta'];

    public function getArchivoRutaAttribute()
    {
        return asset('storage/planes-accion/kanban/tasks/' . $this->task_kanban_p_a_s_id . '/' . $this->archivo);
    }
}
