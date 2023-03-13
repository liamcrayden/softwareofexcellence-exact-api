<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;
use \ArrayAccess;

class PracticeLocation implements ArrayAccess
{
    private $id;
    private $code;
    private $name;
    private $phone;
    private $fax;
    private $line1;
    private $line2;
    private $line3;
    private $postCode;

    public function __construct(object $location) 
    {
        isset($location->id) && $this->id = $location->id;
        isset($location->code) && $this->code = $location->code;
        isset($location->name) && $this->name = $location->name;
        isset($location->phone) && $this->phone = $location->phone;
        isset($location->fax) && $this->fax = $location->fax;
        isset($location->line1) && $this->line1 = $location->line1;
        isset($location->line2) && $this->line2 = $location->line2;
        isset($location->line3) && $this->line3 = $location->line3;
        isset($location->postCode) && $this->postCode = $location->postCode;
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
            'id' => $this->id, 
            'code' => $this->code, 
            'name' => $this->name, 
            'phone' => $this->phone, 
            'fax' => $this->fax,             
            'line1' => $this->line1, 
            'line2' => $this->line2, 
            'line3' => $this->line3, 
            'postCode' => $this->postCode, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;        
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getFax()
    {
        return $this->fax;
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

    public function getPostCode()
    {
        return $this->postCode;
    }    
}