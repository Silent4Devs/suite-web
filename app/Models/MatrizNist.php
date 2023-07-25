<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatrizNist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matriz_nist';

    protected $guarded = ['id'];
}
