<?php

// este modelo no esta en uso

namespace App\Models;

use App\Traits\ClearsResponseCache;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Organizacione extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'organizaciones';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'organizacion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Relación uno a muchos con ClausulasOc
    public function clausulas()
    {
        return $this->hasMany(ClausulasOc::class, 'organizacion_id');
    }
}
