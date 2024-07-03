<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaModule extends Model
{
    use HasFactory;

    protected $table = 'firma_modules';

    protected $fillable = ['modulo_id', 'submodulo_id', 'participantes'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function submodulo()
    {
        return $this->belongsTo(Submodulo::class, 'submodulo_id');
    }

    public function participantes()
    {
        return $this->belongsToMany(Empleado::class);
    }
}
