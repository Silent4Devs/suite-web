<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TimesheetHorasFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function tarea($tarea_id)
    {
        return $this->where('tarea_id', $tarea_id);
    }
}
