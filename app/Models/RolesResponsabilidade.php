<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RolesResponsabilidade extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'roles_responsabilidades';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'responsabilidad',
        'direccionsgsi',
        'comiteseguridad',
        'responsablesgsi',
        'coordinadorsgsi',
        'rol',
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
}
