<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricasObjetivo extends Model
{
    use HasFactory;
    protected $table = 'ev360_metricas_objetivos';
    protected $guarded = ['id'];
}
