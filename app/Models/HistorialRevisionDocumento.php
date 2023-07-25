<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialRevisionDocumento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'documento_id',
        'comentarios',
        'descripcion',
        'fecha',
        'estatus',
        'version',
    ];

    protected $appends = ['fecha_dmy'];

    protected $dates = [
        'fecha',
    ];

    public function getFechaDMYAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
