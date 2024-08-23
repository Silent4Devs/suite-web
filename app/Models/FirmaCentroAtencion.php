<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaCentroAtencion extends Model
{
    use HasFactory;

    protected $table = 'firma_centro_atencions';

    protected $fillable = ['modulo_id', 'submodulo_id', 'user_id', 'firma', 'id_seguridad', 'id_riesgos', 'id_quejas', 'id_mejoras', 'id_denuncias', 'id_sugerencias', 'id_minutas', 'empleado_id'];

    public function empleadoTable()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getFirmaRutaSeguridadAttribute()
    {
        $ruta = asset('storage/seguridad/'.$this->id_seguridad.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaRiesgosAttribute()
    {
        $ruta = asset('storage/riesgos/'.$this->id_riesgos.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaQuejasAttribute()
    {
        $ruta = asset('storage/quejas/'.$this->id_quejas.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaMejorasAttribute()
    {
        $ruta = asset('storage/mejoras/'.$this->id_mejoras.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaDenunciasAttribute()
    {
        $ruta = asset('storage/denuncias/'.$this->id_denuncias.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaSugerenciasAttribute()
    {
        $ruta = asset('storage/sugerencias/'.$this->id_sugerencias.'/firma/'.$this->firma);

        return $ruta;
    }

    public function getFirmaRutaMinutasAttribute()
    {
        $ruta = asset('storage/minuta/'.$this->id_minutas.'/firma/'.$this->firma);

        return $ruta;
    }
}
