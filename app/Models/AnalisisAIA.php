<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisAIA extends Model
{
    use HasFactory;


    public $table = 'analisis_aia';

    const DisruptivoSelect = [
        '1' => 'Remoto (cada año)',
        '2' => 'Poco probable(Cada 6 meses)',
        '3' => 'Probable (Cada 3 meses)',
        '4' => 'Muy probable (cada mes',
        '5' => 'Casi cierto (Cada Semana)',
    ];

    public $fillable = [

        'id',
        'fecha_entrevista',
        'entrevistado',
        'puesto',
        'area',
        'direccion',
        'extencion',
        'correo',
        'aplicaciones_a_cargo',
        // DATOS DE IDENTIFICACIÓN DEL PROCESO
        'id_aplicacion',
        'nombre_aplicacion',
        'version',
        'tipo',
        'objetivo_aplicacion',
        'periodicidad',
        'p_otro_txt',
        'area_pertenece_aplicacion',
        'area_responsable_aplicacion',
        // RESPONSABLES DEL PROCESO
        'titular_nombre',
        'titular_a_paterno',
        'titular_a_materno',
        'titular_puesto',
        'titular_correo',
        'titular_extencion',
        'suplente_nombre',
        'suplente_a_paterno',
        'suplente_a_materno',
        'suplente_puesto',
        'suplente_correo',
        'suplente_extencion',
        'supervisor_nombre',
        'supervisor_a_paterno',
        'supervisor_a_materno',
        'supervisor_puesto',
        'supervisor_correo',
        'supervisor_extencion',
    ];
}
