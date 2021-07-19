<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevisionDocumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'empleado_id',
        'documento_id',
        'comentarios',
        'estatus',
        'nivel',
        'no_revision',
        'version'
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
