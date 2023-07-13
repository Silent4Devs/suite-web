<?php

namespace App\Repos;

use App\Models\TimesheetHoras;

class TimesheetHorasRepo extends RepoBase
{
    public function __construct(TimesheetHoras $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}