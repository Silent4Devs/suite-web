<?php

namespace App\Models\Escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function imageable(){
        return $this->morphTo();
    }
}
