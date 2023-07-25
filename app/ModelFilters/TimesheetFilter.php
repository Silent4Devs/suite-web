<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TimesheetFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function estatus($status)
    {
        return $this->where('estatus', $status);
    }

    public function notEqualsEstatus($estatus)
    {
        return $this->where('estatus', '!=', $estatus);
    }

    public function empleado($empleado_id)
    {
        return $this->where('empleado_id', $empleado_id);
    }

    public function fecha($date)
    {
        return $this->whereMonth('fecha_dia', $date);
    }
}
