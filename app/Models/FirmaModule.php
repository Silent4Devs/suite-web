<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaModule extends Model
{
    use HasFactory;

    protected $table = 'firma_modules';

    protected $fillable = ['modulo_id', 'submodulo_id', 'participantes', 'aprobadores'];

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

    public function getAprobadoresAttribute()
    {
        $users_array = str_replace('[', '', $this->participantes);
        $users_array = str_replace(']', '', $users_array);
        $users_array = str_replace('"', '', $users_array);
        $users_array = str_replace(' ', '', $users_array);
        $users_array = explode(',', $users_array);

        $aprobadores = collect();
        foreach ($users_array as $user_id) {
            $usuario = User::find($user_id);
            if (isset($usuario->empleado)) {
                if ($usuario->empleado->estatus == 'alta') {
                    $aprobadores->push($usuario->empleado);
                }
            }
        }

        return $aprobadores;
    }
}
