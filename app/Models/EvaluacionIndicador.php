<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EvaluacionIndicador.
 *
 * @property int $id
 * @property string|null $no
 * @property string|null $evaluacion
 * @property Carbon|null $fecha
 * @property int|null $resultado
 * @property int|null $id_indicador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property IndicadoresSgsi|null $indicadores_sgsi
 */
class EvaluacionIndicador extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'evaluacion_indicador';

    protected $casts = [
        'resultado' => 'int',
        'id_indicador' => 'int',
    ];

    protected $dates = [
        'fecha' => 'date:d F Y',
    ];

    protected $dateFormat = 'd F Y';

    protected $fillable = [
        'no',
        'evaluacion',
        'fecha',
        'resultado',
        'id_indicador',
    ];

    // protected $appends=['fecha_formateada'];

    public function indicadores_sgsi()
    {
        return $this->belongsTo(IndicadoresSgsi::class, 'id_indicador');
    }

    // public function setFechaAttribute(){

    // }

    // public function getFechaformateada(){

    //     $fecha=Carbon::parse($this->fecha)->format('d-m-Y');
    //     return $fecha;
    // }
}
