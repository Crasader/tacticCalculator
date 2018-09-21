<?php

namespace App\Exceptions\Repository;

class InconsistentDataException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
