<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialRevisionDocumento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'documento_id',
        'comentarios',
        'descripcion',
        'fecha',
        'estatus',
        'version',
    ];

    protected $dates = [
        'fecha'
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
