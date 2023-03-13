<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class OutsideScopeAccessException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct('This operation requires the ' . $message . ' scope. See https://api.ex.softwareofexcellence.com/docs/#scopes.', $code, $previous);
    }
}