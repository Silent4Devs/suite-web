<?php

namespace App\Models\Escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function resourceable()
    {
        return $this->morphTo();
    }
}
