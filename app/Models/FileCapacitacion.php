<?php

namespace App\Models;

use App\Traits\DateTranslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FileCapacitacion extends Model implements Auditable
{
    use HasFactory;
    use DateTranslator;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'files_capacitaciones';

    protected $fillable = ['archivo', 'recurso_id'];

    protected $appends = ['ruta_archivo'];

    public function getRutaArchivoAttribute()
    {
        $folder = "{$this->recurso->id}_recurso";
        $ruta = asset("storage/capacitaciones/recursos/{$folder}/$this->archivo");

        return $ruta;
    }

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id');
    }
}
