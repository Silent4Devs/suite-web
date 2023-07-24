<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnalisisAccionCorrectiva extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'analisis_accion_correctiva';

    protected $guarded = ['id'];

    public function accionCorrectiva()
    {
        return $this->belongsTo(AccionCorrectiva::class, 'accion_correctiva_id', 'id');
    }
}
