<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaDocumento extends Model
{
    use HasFactory;

    protected $table = 'vistas_documentos';

    protected $guarded = [
        'id',
    ];

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->alta();
    }

    public function docummentos()
    {
        return $this->belongsTo(Documento::class, 'documento_id', 'id');
    }
}
