<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class InvalidScopeException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message . ' is not a valid scope. See https://api.ex.softwareofexcellence.com/docs/#scopes.', $code, $previous);
    }
}