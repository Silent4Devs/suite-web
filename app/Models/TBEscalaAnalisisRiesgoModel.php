<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBEscalaAnalisisRiesgoModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'escalas_analisis_riesgos';

    protected $fillable = [
        'id',
        'nombre',
        'valor',
        'color',
        'riesgo_aceptable',
        'min_max_id',
    ];

    public function templateAr_escala()
    {
        return $this->belongsTo(TBTemplateAr_EscalaArModel::class, 'min_max_id');
    }
}
