<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalasMedicionObjetivos extends Model
{
    use HasFactory;

    protected $table = 'escalas_medicion_objetivos';

    protected $fillable = ['parametro', 'color', 'valor'];
}
