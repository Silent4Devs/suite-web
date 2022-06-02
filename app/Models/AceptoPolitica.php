<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AceptoPolitica extends Model
{
    use HasFactory;

    public $table = 'acepto_politica';

    protected $fillable = [
        'id_empleado',
        'id_politica',
        'acepto',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function aceptador()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado')->alta();
    }

    public function politica()
    {
        return $this->belongsTo(PoliticaSgsi::class, 'id_politica');
    }
}
