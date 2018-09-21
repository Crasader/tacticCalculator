<?php
/**
 * Created by PhpStorm.
 * User: kovacsg
 * Date: 2017.06.09.
 * Time: 11:59
 */

namespace App\Exceptions\Api;

use \Exception;

class PagerLimitException extends Exception
{
    public function __construct()
    {
        parent::__construct('Maximum pager limit exceeded.', null, null);
    }
}
