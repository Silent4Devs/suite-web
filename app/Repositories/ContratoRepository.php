<?php

namespace App\Repositories;

use App\Models\Katbol\Contrato;

/**
 * Class ContratoRepository.
 *
 * @version November 25, 2020, 3:51 pm UTC
 */
class ContratoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_contrato',
        'tipo_contrato',
        'proveedor_id',
        'nombre_servicio',
        'objetivo',
        'fecha_inicio',
        'fecha_fin',
        'vigencia_contrato',
        'administrador_contrato',
        'servicios_descripcion',
        'administrador',
        'fecha_firma',
        'periodo_pagos',
        'minimo',
        'maximo',
        'area',
        'puesto',
        'pmp_asignado',
        'clasificacion',
        'fase',
        'contrato_ampliado',
        'convenio_modificatorio',
        'estatus',
        'created_by',
        'updated_by',
        'firma1',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Contrato::class;
    }
}
