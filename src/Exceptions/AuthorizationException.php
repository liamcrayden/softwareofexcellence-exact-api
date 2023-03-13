<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class AuthorizationException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct('Unable to retrieve access token. See https://api.ex.softwareofexcellence.com/docs/#authentication', $code, $previous);
    }
}