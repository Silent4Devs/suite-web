<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoObjetivo extends Model
{
    use HasFactory;

    protected $table = 'ev360_tipo_objetivos';
    protected $guarded = ['id'];

    public function objetivos()
    {
        return $this->hasMany('App\Models\RH\Objetivo', 'tipo_id', 'id');
    }
}
