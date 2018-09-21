<?php

namespace App\Exceptions\Map;

use Exception;

class NoSuchMapItemException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
