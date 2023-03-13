<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Exceptions;

use \Throwable;
use \Exception;

class PracticeInaccessibleException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null) {
        parent::__construct('The practice was inaccessible. Either the practice ID is incorrect or you do not have permission to view this practice.', $code, $previous);
    }
}