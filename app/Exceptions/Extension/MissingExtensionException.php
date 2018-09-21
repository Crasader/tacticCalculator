<?php

namespace App\Exceptions\Extension;

use Exception;

class MissingExtensionException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
