<?php

namespace App\Repositories;

use App\Models\Calendario;

/**
 * Class FechaRepository.
 */
class FechaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nombre',
        'fecha',
        'categoria',
        'descripcion',
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
        return Calendario::class;
    }
}
