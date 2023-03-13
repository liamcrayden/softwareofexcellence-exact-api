<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;
use \ArrayAccess;

class OpeningHours implements ArrayAccess
{
    private $open;
    private $close;

    public function __construct($hours)
    {
        isset($hours->open) && $this->open = $hours->open;
        isset($hours->close) && $this->close = $hours->close;        
    }

    #[\ReturnTypeWillChange]
    public function offsetSet(mixed $offset, $value) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetExists(mixed $offset) 
    {
        return isset($this->{$offset});
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset(mixed $offset) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset) 
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

    public function toArray()
    {
        return [ 
            'open' => $this->open, 
            'close' => $this->close, 
        ];
    }

    public function getOpen()
    {
        return $this->open;
    }

    public function getClose()
    {
        return $this->close;
    }
}