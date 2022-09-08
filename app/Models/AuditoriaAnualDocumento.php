<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaAnualDocumento extends Model
{
    use HasFactory;

    public $table = 'documento_auditoria_anuals';


    protected $fillable = [
        'documento',
        'id_auditoria_anuals',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function auditoria_anual()
    {
        return $this->belongsTo(AuditoriaAnual::class, 'id_auditoria_anuals');
    }
}
