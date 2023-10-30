<?php

namespace App\Models;

use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GapUno extends Model implements Auditable
{
    use MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;
    public $table = 'gap_logro_uno';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pregunta',
        'valoracion',
        'evidencia',
        'recomendacion',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'pregunta' => 'string',
        'valoracion' => 'string',
        'evidencia' => 'string',
        'recomendacion' => 'string',
    ];

    const VALORACION_SELECT = [
        'Cumple satisfactoriamente' => 'Cumple satisfactoriamente',
        'Cumple parcialmente' => 'Cumple parcialmente',
        'No cumple' => 'No cumple',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function analisis_brecha()
    {
        return $this->belongTo(AnalisisBrecha::class);
    }
}
