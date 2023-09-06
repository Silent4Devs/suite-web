<?php

namespace App\Models\ContractManager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Comprador extends Model
{
    use HasFactory;


    public $table = 'compradores';

    public $fillable = [
        'clave',
        'nombre',
        'estado',
        'id_user',
        'archivo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
