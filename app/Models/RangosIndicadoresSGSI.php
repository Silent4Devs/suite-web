<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RangosIndicadoresSGSI extends Model
{
    //
    protected $table = 'rangos_indicadores_s_g_s_i_s';

    protected $fillable = [
        'valor_minimo',
        'valor_maximo',
        'flujo',
        'id_indicador_sgsi',
    ];

    public function indicadorsgsi()
    {
        $this->belongsTo(IndicadoresSgsi::class, 'id_indicador_sgsi', 'id');
    }
}
