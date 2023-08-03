<?php

namespace App\Repos;

use App\Models\Timesheet;

class TimesheetsRepo extends RepoBase
{
    public function __construct(Timesheet $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}
