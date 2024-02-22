<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Resource extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = ['id'];

    public function resourceable()
    {
        return $this->morphTo();
    }
}
