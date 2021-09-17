<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCompetencia extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ev360_tipo_competencias';
    protected $guarded = ["id"];
}
