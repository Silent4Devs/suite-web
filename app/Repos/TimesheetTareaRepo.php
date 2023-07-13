<?php

namespace App\Repos;

use App\Models\TimesheetTarea;

class TimesheetTareaRepo extends RepoBase
{
    public function __construct(TimesheetTarea $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}