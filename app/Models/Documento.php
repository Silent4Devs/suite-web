<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    //REVISION DE DOCUMENTOS ESTATUS
    const SOLICITUD_REVISION = 1;
    const APROBADO = 2;
    const RECHAZADO = 3;

    // DOCUMENTOS ESTATUS
    const EN_ELABORACION = 1;
    const EN_REVISION = 2;
    const PUBLICADO = 3;
    const DOCUMENTO_RECHAZADO = 4;

    protected $dates = ['fecha'];

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'macroproceso_id',
        'estatus',
        'version',
        'fecha',
        'archivo',
        'elaboro_id',
        'reviso_id',
        'aprobo_id',
        'responsable_id'
    ];

    //Relacion uno a muchos inversa
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function revisores()
    {
        return $this->belongsToMany(Empleado::class);
    }


    public function revisiones()
    {
        return $this->hasMany(RevisionDocumento::class, 'documento_id', 'id');
    }

    public function revisor()
    {
        return $this->belongsTo(Empleado::class, 'reviso_id', 'id');
    }

    public function macroproceso()
    {
        return $this->belongsTo(Macroproceso::class, 'macroproceso_id', 'id');
    }

    public function elaborador()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'id');
    }

    public function aprobador()
    {
        return $this->belongsTo(Empleado::class, 'aprobo_id', 'id');
    }
    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id');
    }
}
