<?php

namespace App\Exceptions\Repository;

use \Exception;

class RainfallTypeNotExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Cannot order entities by given key', null, null);
    }
}
