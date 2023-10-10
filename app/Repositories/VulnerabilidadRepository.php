<?php

namespace App\Repositories;

use App\Models\Vulnerabilidad;

/**
 * Class VulnerabilidadRepository.
 *
 * @version August 5, 2021, 7:45 pm UTC
 */
class VulnerabilidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'id_amenaza',
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
        return Vulnerabilidad::class;
    }
}
