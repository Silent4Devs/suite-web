<?php

namespace App\Models;

use App\Traits\DateTranslator;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdiomaEmpleado extends Model implements Auditable
{
    use HasFactory;
    use DateTranslator;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    const NIVELES = [
        'Basico' => 'Básico',
        'Intermedio' => 'Intermedio',
        'Avanzado' => 'Avanzado',
    ];

    protected $fillable = [
        'nombre',
        'nivel',
        'porcentaje',
        'certificado',
        'empleado_id',
        'id_language',
    ];

    protected $appends = ['ruta_documento', 'ruta_absoluta_documento'];

    public function getRutaDocumentoAttribute()
    {
        return asset('storage/cursos_empleados/') . '/' . $this->certificado;
    }

    public function getRutaAbsolutaDocumentoAttribute()
    {
        return "cursos_empleados/{$this->certificado}";
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->alta();
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'id_language', 'id');
    }
}
