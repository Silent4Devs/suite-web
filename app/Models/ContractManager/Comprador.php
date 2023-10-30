<?php

namespace App\Models\ContractManager;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comprador extends Model
{
    use HasFactory, ClearsResponseCache;

    public $table = 'compradores';

    public $fillable = [
        'id',
        'clave',
        'nombre',
        'estado',
        'id_user',
        'archivo',
    ];

    public function user()
    {
        return $this->belongsTo(Empleado::class, 'id_user');
    }
}
