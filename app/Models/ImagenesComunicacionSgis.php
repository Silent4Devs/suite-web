<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ImagenesComunicacionSgis extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'imagenes_comunicacion_sgis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comunicacion_id',
        'imagen',
        'tipo',
    ];

    public function imagenes_comunicacion()
    {
        return $this->belongsTo(ComunicacionSgi::class, 'comunicacion_id');
    }
}
