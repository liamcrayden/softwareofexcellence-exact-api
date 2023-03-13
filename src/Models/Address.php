<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;
use \ArrayAccess;

class Address implements ArrayAccess
{
    private $line1 ;
    private $line2;
    private $line3;
    private $line4;
    private $postCode;

    public function __construct($address)
    {
        isset($address->line1) && $this->line1 = $address->line1;
        isset($address->line2) && $this->line2 = $address->line2;
        isset($address->line3) && $this->line3 = $address->line3;
        isset($address->line4) && $this->line4 = $address->line4;
        isset($address->postCode) && $this->postCode = $address->postCode;
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
            'line1' => $this->line1, 
            'line2' => $this->line2, 
            'line3' => $this->line3, 
            'line4' => $this->line4, 
            'postCode' => $this->postCode, 
        ];
    }

    public function getLine1()
    {
        return $this->line1;
    }

    public function getLine2()
    {
        return $this->line2;        
    }

    public function getLine3()
    {
        return $this->line3;
    }

    public function getLine4()
    {
        return $this->line4;
    }

    public function getPostCode()
    {
        return $this->postCode;
    }    
}