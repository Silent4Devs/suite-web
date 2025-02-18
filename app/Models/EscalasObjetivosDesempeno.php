<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalasObjetivosDesempeno extends Model
{
    use HasFactory;

    // Condiciones Escalas
    const MENOR_QUE = 1;

    const MENOR_O_IGUAL_QUE = 2;

    const IGUAL_QUE = 3;

    const MAYOR_QUE = 4;

    const MAYOR_O_IGUAL_QUE = 5;

    protected $appends =
        [
            'condicion_palabra',
            'condicion_signo',
        ];

    protected $table = 'escalas_objetivos_desempenos';

    protected $fillable = [
        'id_objetivo_desempeno',
        'condicion',
        'valor',
        'parametro',
        'color',
        'no_periodo'
    ];

    // public function parametro()
    // {
    //     return $this->belongsTo(EscalasMedicionObjetivos::class, 'parametro_id', 'id');
    // }

    public function getCondicionPalabraAttribute()
    {
        switch ($this->condicion) {
            case strval($this::MENOR_QUE):
                return 'Menor que';
                break;
            case strval($this::MENOR_O_IGUAL_QUE):
                return 'Menor o igual que';
                break;
            case strval($this::IGUAL_QUE):
                return 'Igual que';
                break;
            case strval($this::MAYOR_QUE):
                return 'Mayor que';
                break;
            case strval($this::MAYOR_O_IGUAL_QUE):
                return 'Mayor o igual que';
                break;
            default:
                return '=';
                break;
        }
    }

    public function getCondicionSignoAttribute()
    {
        switch ($this->condicion) {
            case strval($this::MENOR_QUE):
                return '<';
                break;
            case strval($this::MENOR_O_IGUAL_QUE):
                return '=<';
                break;
            case strval($this::IGUAL_QUE):
                return '=';
                break;
            case strval($this::MAYOR_QUE):
                return '>';
                break;
            case strval($this::MAYOR_O_IGUAL_QUE):
                return '>=';
                break;
            default:
                return '=';
                break;
        }
    }
}
