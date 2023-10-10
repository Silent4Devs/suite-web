<?php

namespace App\Repositories;

use App\Models\Tenant;

/**
 * Class AmenazaRepository.
 * @version August 5, 2021, 6:19 pm UTC
 */
class TenantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
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
        return Tenant::class;
    }
}
