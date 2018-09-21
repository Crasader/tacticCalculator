<?php

namespace App\Exceptions\Repository;

use \Exception;

class InvalidFilterValueException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
