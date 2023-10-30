<?php

namespace App\Models\Iso27;

use App\Models\Empleado;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisBrechasIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'nombre',
        'fecha',
        'porcentaje_implementacion',
        'id_elaboro',
        'estatus',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elaboro')->alta();
    }

    // public function gap_logro_tres()
    // {
    //     return $this->hasMany(GapTre::class, 'analisis_brechas_id');
    // }

    // public function gap_logro_dos()
    // {
    //     return $this->hasMany(GapDo::class, 'analisis_brechas_id');
    // }

    // public function gap_logro_unos()
    // {
    //     return $this->hasMany(GapUno::class, 'analisis_brechas_id');
    // }
}
