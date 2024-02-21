<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use ClearsResponseCache, HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public $table = 'reportes';
}
