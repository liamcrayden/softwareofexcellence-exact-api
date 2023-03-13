<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class InvalidEnvironmentException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message . ' is not a valid environment. Acceptable values are: qa, production', $code, $previous);
    }
}