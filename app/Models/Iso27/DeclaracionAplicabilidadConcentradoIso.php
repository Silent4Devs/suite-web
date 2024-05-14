<?php

namespace App\Models\Iso27;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DeclaracionAplicabilidadConcentradoIso extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'valoracion',
        'id_gap_dos_catalogo',
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
        return $this->hasOne(DeclaracionAplicabilidadResponsableIso::class, 'declaracion_id', 'id_gap_dos_catalogo');
    }

    public function aprobadores2022()
    {
        return $this->hasOne(DeclaracionAplicabilidadAprobarIso::class, 'declaracion_id', 'id_gap_dos_catalogo');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->alta();
    }

    public function notificacion()
    {
        return $this->hasMany(App\Models\Iso27\NotificacionAprobadores::class, 'declaracion_id', 'id');
    }

    public function control()
    {
        return $this->belongsTo(self::class, 'anexo_indice', 'id', 'anexo_politica');
    }
}
