<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosListaInformativa extends Model
{
    use HasFactory;

    protected $table = 'usuarios_lista_informativas';

    protected $fillable = [
        'modulo_id',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id')->select('id', 'name', 'email', 'empleado_id', 'n_empleado');
    }
}
