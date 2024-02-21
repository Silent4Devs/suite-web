<?php

namespace App\Exceptions;

use Exception;

class MiExcepcionTimeshetClientes extends Exception
{
    public function __construct()
    {
        parent::__construct('El registro ya ha sido eliminado.');
    }
}
