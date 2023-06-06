<?php

namespace App\Models\Iso27;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Empleado;
use App\Models\NotificacionAprobadores;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;
use App\Models\Iso27\DeclaracionAplicabilidadAprobarIso;

class DeclaracionAplicabilidadConcentradoIso extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'valoracion',
        'id_gap_dos_catalogo'
    ];

    public function gapdos()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id', 'id_gap_dos_catalogo');
    }

    public function getContentAttribute()
    {
        return Str::limit($this->anexo_politica, 50, '...') ? Str::limit($this->anexo_politica, 50, '...') : 'Sin Contenido';
    }

    public function responsables2022()
    {
        return $this->belongsToMany(Empleado::class, 'declaracion_aplicabilidad_responsable_isos', 'declaracion_id', 'aprobadores_id');
    }

    public function aprobadores2022()
    {
        return $this->belongsToMany(Empleado::class, 'declaracion_aplicabilidad_aprobar_isos', 'declaracion_id', 'aprobadores_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'aprobadores_id', 'id')->alta();
    }

    // public function notificacion()
    // {
    //     return $this->hasMany(NotificacionAprobadores::class, 'declaracion_id', 'id');
    // }

    public function control()
    {
        return $this->belongsTo(self::class, 'anexo_indice', 'id', 'anexo_politica');
    }
}
