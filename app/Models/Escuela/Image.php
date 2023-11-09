<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, ClearsResponseCache;

    protected $guarded = ['id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
