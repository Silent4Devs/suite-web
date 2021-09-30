<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competencia extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ev360_competencias';
    protected $guarded = ["id"];

    public function tipo()
    {
        return $this->belongsTo('App\Models\RH\TipoCompetencia', 'tipo_id', 'id');
    }

    public function opciones()
    {
        return $this->hasMany('App\Models\RH\Conducta', 'competencia_id', 'id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : static::where('id', 'ILIKE', '%' . $search . '%')
            ->orWhere('nombre', 'ILIKE', '%' . $search . '%')
            ->orWhere('descripcion', 'ILIKE', '%' . $search . '%');
    }
}
