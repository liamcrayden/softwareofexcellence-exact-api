<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class APITransportException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct('API transport exception. ' . $message, $code, $previous);
    }
}