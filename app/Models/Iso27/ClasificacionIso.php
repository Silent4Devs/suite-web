<?php

namespace App\Models\Iso27;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClasificacionIso extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'nombre',
    ];
}
