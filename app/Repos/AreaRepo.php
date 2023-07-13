<?php

namespace App\Repos;

use App\Models\Area;

class AreaRepo extends RepoBase
{
    public function __construct(Area $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}