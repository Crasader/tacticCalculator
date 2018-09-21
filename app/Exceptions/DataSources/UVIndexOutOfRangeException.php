<?php

namespace App\Exceptions\DataSources;

use Exception;

class UVIndexOutOfRangeException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
