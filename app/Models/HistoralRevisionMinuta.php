<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoralRevisionMinuta extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
