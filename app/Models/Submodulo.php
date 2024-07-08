<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    use HasFactory;

    protected $fillable = ['modulo_id', 'name'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
