<?php

namespace App\Models\Visitantes;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableVisitantes extends Model
{
    use HasFactory;

    protected $table = 'responsable_visitantes';

    protected $fillable = [
        'empleado_id',
        'fotografia_requerida'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
