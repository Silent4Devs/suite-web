<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaCentroAtencion extends Model
{
    use HasFactory;

    protected $table = 'firma_centro_atencions';

    protected $fillable = ['modulo_id', 'submodulo_id', 'user_id', 'firma', 'id_seguridad', 'id_riesgos', 'id_quejas', 'id_mejoras', 'id_denuncias', 'id_sugerencias', 'id_minutas'];

    public function empleado()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}