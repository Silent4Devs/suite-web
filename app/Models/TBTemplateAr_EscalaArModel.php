<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBTemplateAr_EscalaArModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'template_ar__escalas_ar_pivote';

    protected $fillable = [
        'id',
        'template_id',
        'valor_min',
        'valor_max',
    ];

    public function getTemplate()
    {

        return $this->belongsTo(TBTemplateAnalisisRiesgoModel::class, 'template_id');

    }

    public function getEscalas()
    {

        return $this->hasMany(TBEscalaAnalisisRiesgoModel::class, 'min_max_id', 'id')->orderBy('id', 'asc');

    }
}
