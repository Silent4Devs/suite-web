<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * Class Sede.
 *
 * @property int $id
 * @property string $sede
 * @property string|null $foto_sedes
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $organizacion_id
 * @property int|null $team_id
 * @property string|null $direccion
 *
 * @property Organizacion|null $organizacion
 * @property Team|null $team
 * @property Collection|Activo[] $activos
 * @property Collection|Empleado[] $empleados
 */
class Sede extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'sedes';

    protected $casts = [
        'organizacion_id' => 'int',
        'team_id' => 'int',
    ];

    protected $fillable = [
        'sede',
        'foto_sedes',
        'descripcion',
        'organizacion_id',
        'team_id',
        'direccion',
        'latitude',
        'longitud',
    ];

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('sedes_all', 3600*24, function () {
            return self::get();
        });
    }

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'organizacion_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function activos()
    {
        return $this->hasMany(Activo::class, 'ubicacion_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class)->alta();
    }
}
