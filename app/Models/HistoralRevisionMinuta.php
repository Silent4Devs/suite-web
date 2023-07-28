<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class HistoralRevisionMinuta extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'minuta_id',
        'comentarios',
        'descripcion',
        'fecha',
        'estatus',
    ];

    protected $appends = ['fecha_dmy'];

    protected $dates = [
        'fecha',
    ];

    public function getFechaDMYAttribute()
    {
        return Carbon::parse($this->fecha)->format('d-m-Y');
    }

    public function minuta()
    {
        return $this->belongsTo(Minutasaltadireccion::class, 'minuta_id', 'id');
    }
}
