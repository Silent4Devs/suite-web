<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function resourceable()
    {
        return $this->morphTo();
    }
}
