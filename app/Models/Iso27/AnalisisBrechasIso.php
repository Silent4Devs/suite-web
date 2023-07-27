<?php

namespace App\Models\Iso27;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnalisisBrechasIso extends Model
{
    use HasFactory,SoftDeletes;

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
