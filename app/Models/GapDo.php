<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GapDo extends Model
{
    use MultiTenantModelTrait, HasFactory;

    public $table = 'gap_logro_dos';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const VALORACION_SELECT = [
        'Cumple satisfactoriamente' => 'Cumple satisfactoriamente',
        'Cumple parcialmente' => 'Cumple parcialmente',
        'No cumple' => 'No cumple',
        'No aplica' => 'No aplica',
    ];

    protected $fillable = [
        'control-uno',
        'control-dos',
        'anexo_indice',
        'control',
        'descripcion_control',
        'valoracion',
        'evidencia',
        'recomendacion',
        'created_at',
        'updated_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format').' '.config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
