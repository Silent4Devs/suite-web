<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Dmaic extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'dmaics';

    public static $searchable = [
        'leccionesaprendidas',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mejora_id',
        'definir',
        'medir',
        'analizar',
        'implementar',
        'controlar',
        'leccionesaprendidas',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function mejora()
    {
        return $this->belongsTo(Registromejora::class, 'mejora_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
