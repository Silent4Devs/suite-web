<?php

namespace App\Repos;

use App\Models\Empleado;

class EmpleadoRepo extends RepoBase
{
    public function __construct(Empleado $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}
