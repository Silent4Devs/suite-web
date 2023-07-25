<?php

namespace App\Repositories;

use App\Models\Amenaza;

/**
 * Class AmenazaRepository.
 *
 * @version August 5, 2021, 6:19 pm UTC
 */
class AmenazaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
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
        return Amenaza::class;
    }
}
