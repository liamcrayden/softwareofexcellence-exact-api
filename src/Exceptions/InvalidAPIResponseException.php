<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Exception;

class InvalidAPIResponseException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct('Invalid or unexpected API response. The response was: ' . $message, $code, $previous);
    }
}