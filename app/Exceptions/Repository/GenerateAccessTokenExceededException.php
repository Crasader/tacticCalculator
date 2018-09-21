<?php

namespace App\Exceptions\Repository;

class GenerateAccessTokenExceededException extends \Exception
{
    public function __construct($message = 'Nem tudtam access tokent generálni.')
    {
        parent::__construct($message, null, null);
    }
}
