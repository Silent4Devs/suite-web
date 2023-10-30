<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciasQueja extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'evidencias_quejas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_quejas' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_quejas',
        'evidencia',
    ];

    public function quejas()
    {
        return $this->belongsTo(Quejas::class, 'id_quejas');
    }
}
