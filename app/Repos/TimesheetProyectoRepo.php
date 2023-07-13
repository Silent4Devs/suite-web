<?php 

namespace App\Repos;

use App\Models\TimesheetProyecto;

class TimesheetProyectoRepo extends RepoBase
{
    public function __construct(TimesheetProyecto $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        return true;
    }
}