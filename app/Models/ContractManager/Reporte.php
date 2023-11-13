<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory, ClearsResponseCache;

    protected $fillable = [
        'nombre',
        ];

    public $table = 'reportes';
}
