<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use ClearsResponseCache, HasFactory;

    protected $guarded = ['id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
