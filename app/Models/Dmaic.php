<?php

namespace App\Models;

use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dmaic extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
